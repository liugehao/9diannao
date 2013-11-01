from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector
from scrapy.http import Request
from drupal2s.items import Drupal2SItem

class T1(BaseSpider):
    name = 't1'
    allowed_domains = ['cnbeta.com']
    start_urls = ('http://cnbeta.com/articles/209210.htm',)
    
    def parse(self, response):
        hxs = HtmlXPathSelector(response)
        it = Drupal2SItem()
        it['title'] = hxs.select('//*/title/text()').extract()
        it['body'] = hxs.select('/html/bod/div/section/section/article/div/div/div[2]').extract()
        it['image_urls'] = hxs.select('/html/body/div/section/section/article/div/div/div[2]/img/@src').extract()
        print it.get('image_urls')
        print '-' * 100
        return it
