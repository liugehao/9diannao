from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector
from urlparse import urljoin
from scrapy.http import Request
from drupal2s.items import Drupal2SItem

class GanjiSpder(BaseSpider):
    name = "ganji"
    allowed_domains = ["ganji.com"]
    start_urls = [
        #"http://hljyichun.ganji.com/taishidiannaozhengji/",
        #'http://hljyichun.ganji.com/diannao/579899450x.htm',
        'http://hljyichun.ganji.com/diannao/561322299x.htm',
    ]

    def p1arse(self, response):
        hxs = HtmlXPathSelector(response)
        for url in hxs.select('//*[@id="wrapper"]/div[4]/div/dl/dt/div/a/@href').extract():
            url = urljoin(response.url, url)
            print url
            return Request(url, callback=self.detailparse)
    
    def parse(self, response):
        hxs = HtmlXPathSelector(response)
        result = Drupal2SItem()
        print response.url,'--------------'
        result['title'] = hxs.select('//*[@id="wrapper"]/div[3]/div[1]/div[1]/h1/text()').extract()[0]
        result['price'] = hxs.select('//*[@id="wrapper"]/div[3]/div[1]/div[3]/div/ul/li[1]/span/b/text()').extract()[0]
        result['contacts'] = hxs.select('//*[@id="wrapper"]/div[3]/div[1]/div[3]/div/ul/li/text()').extract()[4].replace("\n","")
        tmp = hxs.select('//*[@id="wrapper"]/div[3]/div[1]/div[4]/div[2]/div/div')
        txt = tmp.select('text()').extract()
        atxt = tmp.select('a/text()').extract()
        tmp = ''
        for i in range(len(txt)):
            tmp += txt[i]
            if i < len(atxt) :
                tmp += atxt[i]
    
        result['body'] = tmp
        return result
