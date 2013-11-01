#coding=utf-8
from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector
from urlparse import urljoin
from scrapy.http import Request
from scrapy.http import FormRequest
from drupal2s.items import Drupal2SItem
import re
import datetime

class BaixingSpider(BaseSpider):
    name = 'baixing'
    allowed_domains = ['baixing.com', 'baixing.net']
    download_delay = 3
    start_urls = []
    category = {u"其它":25, u"台式机":13,  u"笔记本":14, u"配件":19,  u"宽带及配件":17, u"iPad/平板":15}
    
    def __init__(self, **kwargs):
        #self.quyu = {'yichun':u'伊春','suihua':u'绥化','shuangyashan':u'双鸭山','qitaihe':u'七台河','qiqihaer':u'齐齐哈尔','mudanjiang':u'牡丹江','jixi':u'鸡西','jiamusi':u'佳木斯','heihe':u'黑河','hegang':u'鹤岗','haerbin':u'哈尔滨','daqing':u'大庆','daxinganling':u'大兴安岭'}
        self.quyu = ('shanghai','beijing','tianjin','chongqing','handan','shijiazhuang','baoding','zhangjiakou','chengde','tangshan','langfang','cangzhou','hengshui','xingtai','qinhuangdao','shuozhou','xinzhou','taiyuan','datong','yangquan','jinzhong','changzhi','jincheng','linfen','lvliang','yuncheng','hulunbeier','huhehaote','baotou','wuhai','wulanchabu','tongliao','chifeng','eerduosi','bayannaoer','xilinguole','xingan','alashan','shenyang','tieling','dalian','anshan','fushun','benxi','dandong','jinzhou','yingkou','fuxin','liaoyang','chaoyang','panjin','huludao','changchun','jilin','yanbian','siping','tonghua','baicheng','liaoyuan','songyuan','baishan','jixi','qitaihe','hegang','shuangyashan','yichun','haerbin','qiqihaer','mudanjiang','jiamusi','heihe','suihua','daqing','daxinganling','nanjing','wuxi','zhenjiang','suzhou','nantong','yangzhou','yancheng','xuzhou','huaian','lianyungang','changzhou','tz','suqian','kunshan','changshu','zhangjiagang','taicang','quzhou','hangzhou','huzhou','jiaxing','ningbo','shaoxing','taizhou','wenzhou','lishui','jinhua','zhoushan','chuzhou','fuyang','hefei','bengbu','wuhu','huainan','maanshan','anqing','sz','bozhou','huangshan','huaibei','tongling','xuancheng','luan','chaohu','chizhou','taian','heze','jinan','qingdao','zibo','dezhou','yantai','weifang','jining','weihai','linyi','binzhou','dongying','zaozhuang','rizhao','laiwu','liaocheng','shangqiu','zhengzhou','anyang','xinxiang','xuchang','pingdingshan','xinyang','nanyang','kaifeng','luoyang','jiaozuo','hebi','puyang','zhoukou','luohe','zhumadian','sanmenxia','jiyuan','yueyang','changsha','xiangtan','zhuzhou','hengyang','chenzhou','changde','yiyang','loudi','shaoyang','xiangxi','zhangjiajie','huaihua','yongzhou','wuhan','xiantao','tianmen','qianjiang','xiangfan','ezhou','xiaogan','huanggang','huangshi','xianning','jingzhou','yichang','shiyan','suizhou','jingmen','enshi','shennongjia','yingtan','xinyu','nanchang','jiujiang','shangrao','fz','yc','jian','ganzhou','jingdezhen','pingxiang','fuzhou','xiamen','ningde','putian','quanzhou','zhangzhou','longyan','sanming','nanping','guangzhou','shanwei','yangjiang','jieyang','maoming','jiangmen','shaoguan','huizhou','meizhou','shantou','shenzhen','zhuhai','foshan','zhaoqing','zhanjiang','zhongshan','heyuan','qingyuan','yunfu','chaozhou','dongguan','laibin','hezhou','chongzuo','yl','fangchenggang','nanning','liuzhou','guilin','wuzhou','guigang','bose','qinzhou','hechi','beihai','sanya','danzhou','dongfang','wenchang','qionghai','wuzhishan','wanning','haikou','baisha','sansha','baoting','changjiang','chengmai','dingan','ledong','lingao','lingshui','qiongzhong','tunchang','chengdu','meishan','ziyang','panzhihua','zigong','mianyang','nanchong','dazhou','suining','guangan','bazhong','luzhou','yibin','neijiang','leshan','liangshan','yaan','ganzi','aba','deyang','guangyuan','guiyang','zunyi','anshun','qiannan','qiandongnan','tongren','bijie','liupanshui','qianxinan','xishuangbanna','dehong','zhaotong','kunming','dali','honghe','qujing','baoshan','wenshan','yuxi','chuxiong','puer','lincang','nujiang','diqing','lijiang','lasa','rikaze','shannan','linzhi','changdu','naqu','ali','xian','xianyang','yanan','yulin','weinan','shangluo','ankang','hanzhong','baoji','tongchuan','longnan','wuwei','jiayuguan','linxia','lanzhou','dingxi','pingliang','qingyang','jinchang','zhangye','jiuquan','tianshui','gannan','baiyin','haibei','xining','haidong','huangnan','guoluo','yushu','haixi','hainan','zhongwei','yinchuan','shizuishan','wuzhong','guyuan','yili','tacheng','hami','hetian','aletai','boertala','kelamayi','wulumuqi','shihezi','changji','tulufan','bayinguoleng','akesu','kashi','kezilesu','alaer','wujiaqu','tumushuke',)
        for i in self.quyu:
            for page in range(1,5):
                self.start_urls.append("http://%s.baixing.com/bijiben/?page=%s" % (i, page))


        #self.start_urls.append('http://haerbin.baixing.com/bijiben/a273913166.html')
        super(BaixingSpider, self).__init__(self, **kwargs)
        
    def __str__(self): 
        return "BaixingSpider"
    
    def parse(self, response):
        hxs = HtmlXPathSelector(response)
        #///html/body/div[3]/div[2]/div[2]/div[2]/ul/li/div/div/a
        #//*[@id="media"]/li[1]/div/div[1]/a
        #for url in hxs.select('//*[@id="media"]/li[1]/div/div[1]/a/@href').extract():
        #    yield Request(urljoin(response.url, url), callback=self.parse_item)
            
        #for url in hxs.select('//*[@id="pinned-list"]/ul/li/span[1]/a/@href').extract():
        #    yield Request(urljoin(response.url, url), callback=self.parse_item)
        for div in hxs.select('//*[@id="media"]/li/div'):
            title = div.select('div/a/text()').extract()[0]
            try:
                price = div.select('div/span/text()').re(r'(\d.*?)[^\d]')[0] #.extract()[0].strip(u'元')
            except:
                price = 0
            url = div.select('div/a/@href').extract()[0]
            yield Request(url=urljoin(response.url, url),
                          meta=dict(title=title, price=price),
                          callback=self.parse_item)

                
            
    def parse_item(self, response):
        hxs = HtmlXPathSelector(response)
        i = Drupal2SItem()
        i['url'] = response.url
        i['price'] = response.meta['price']
        i['title'] = response.meta['title']
        try:
            i['contact'] = ''
        except:
            i['contact'] = ''
        try:
            category =  hxs.select('/html/body/div[3]/div[2]/div[3]/div[1]/span[1]/text()').extract()[0]
        except:
            category =  hxs.select('/html/body/div[3]/div[2]/div[4]/div[1]/span[1]/text()').extract()[0]
        #/html/body/div[3]/div[2]/div[4]/div[1]/span[1]
        if category in self.category:
            i['category'] = str(self.category[category])
        else:
            i['category'] = '24'
        try:    
            i['body'] = hxs.select('//html/body/div[3]/div[2]/div[3]/div[2]/text()').extract()[0]
        except:
            try:
                i['body'] = hxs.select('//html/body/div[3]/div[2]/div[4]/div[2]/text()').extract()[0]
            except:
                i['body'] = ''
                
        
        i['city'] = '' #self.quyu[re.search(r'http://(.*?)\.baixing.com/',response.url).groups()[0]]
        try:
            i['county'] = hxs.select('//*[@id="vcontent"]/div/a[1]/text()').extract()[0]
        except:
            i['county'] = ''
        try:
            i['address'] = hxs.select('//*[@id="vcontent"]/div/a[2]/text()').extract()[0].replace('[地图及交通]','')
        except:
            i['address'] = ''
        try:
            i['address'] = "%s %s" % (address, ' '.join([ x.replace('&nbsp;', '').replace('-', '') for x in hxs.select('//*[@id="vcontent"]/div/span/text()').extract()]))
        except:
            pass
            
        i['phone'] = hxs.select('//*[@id="num"]/text()').extract()[0].replace('****', hxs.select('/html/body/div[3]/div[2]/div/div[2]/a[2]/@data-contact').extract()[0])
        
        #i['body'] = "%s\n%s\n\n%s%s%s" % (i['body'], '-' * 30, city, county, address)
        i['image_urls'] = hxs.select('//*/div[@class="maincol"]/div/div/img/@src').extract()
        try:
            tmp = hxs.select('/html/body/div[3]/div[2]/div[5]/span[1]/text()').re('(\d.*?)[^\d]')
            if not tmp:
                tmp = hxs.select('/html/body/div[3]/div[2]/div[4]/span[1]/text()').re('(\d.*?)[^\d]')
            i['created'] = datetime.datetime(datetime.datetime.now().year, int(tmp[0]), int(tmp[1]), int(tmp[2]), int(tmp[3])).strftime("%Y-%m-%d %H:%M-%S")
        except:
            print tmp
            print response.url

            
        return i        
   
