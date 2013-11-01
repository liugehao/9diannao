#coding=utf-8
from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector
from urlparse import urljoin
from scrapy.http import Request
from scrapy.http import FormRequest
from drupal2s.items import Drupal2SItem
import re

class LjclubSpider(BaseSpider):
    name = 'ljclub'
    allowed_domains = ['ljclub.cn']
    start_urls = []
    category = {u"其它":24, u"兼容机":9, u"品牌电脑":9, u"笔记本":10, u"电脑配件":11, u"电脑外设":17, u"网络产品":20, u"数码类":21, u"办公设备":22, u"服务器":23}
    
    def __init__(self):
        i = 10
        while i > 0:
            self.start_urls.append('http://www.ljclub.cn/forum-14-%s.html' % i)
            i -= 1

    def parse(self, response):
        hxs = HtmlXPathSelector(response)
        for url in hxs.select('//tr/th/a[1]/@href').re(r'th.*'):
            yield Request(urljoin(response.url, url), callback=self.parse_item)
            
    def parse_item(self, response):
        hxs = HtmlXPathSelector(response)
        i = Drupal2SItem()
        
        i['price'] = '0'
        i['title'] = hxs.select('//*[@id="thread_subject"]/text()').extract()[0]
        i['category'] = hxs.select('//*[@id="postlist"]/table[1]/tr/td[2]/h1/a[1]/text()').extract()[0].strip('[]')
        if i['category'] in self.category:
            i['category'] = str(self.category[i['category']])
        else:
            i['category'] = '24'
            
        i['body'] = ''.join([x for x in hxs.select('//*/td[@class="t_f"][@id]')[0].select('text()').extract()])
        try:
            if i['price'] == '0':
                i['price'] = re.findall(u'(\d*?)元',i['title'])[0]
                if not re.search('^(\d+)$',i['price']):
                    i['price'] = '0'
        except:
            pass
        try:
            if i['price'] == '0':
                i['price'] = re.findall(u'(\d*?)元',i['body'])[0]
                if not re.search('^(\d+)$',i['price']):
                    i['price'] = '0'
        except:
            pass
        try:
            i['phone'] = re.search(r'\d{11}', i['body']).groups()[0]
        except:            
            i['phone'] = ''
        
        return i
        