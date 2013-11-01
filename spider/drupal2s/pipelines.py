#coding=utf-8
# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/topics/item-pipeline.html

#import urllib2,urllib
from db import session, Area, Product, Myfile
from scrapy import log
class Drupal2SPipeline(object):
    def process_item(self, item, spider):
        """
        for x in item['images']:
            print x['path']
            print '-' * 60
        """
        try:
            county = session.query(Area).filter(Area.name.like('%s%%' % item['county'])).first()
            city = session.query(Area).filter(Area.id == county.pid).first()
            province = session.query(Area).filter_by(id=city.pid).first()
            province.id
        except:
            log.msg(u'未找到省市区县 %s' % item['url'], level=log.WARNING)
            return item
    
        p = Product()
        p.title = item['title']
        p.body = item['body']
        p.created = item['created']
        p.phone = item['phone']
        p.contact = item['contact']
        p.address = item['address']
        p.city = county.pid
        p.province = province.id
        p.county = county.id
        p.category = item['category']
        p.price = item['price']
        session.add(p)
        try:
            session.commit()
        except:
            session.rollback()
            log.msg(item, level=log.ERROR)
            return item
        for img in item['images']:
            imgp = Myfile()
            imgp.path = img['path']
            #print img['path']
            imgp.product_id = p.id
            session.add(imgp)
            try:
                session.commit()
            except:
                log.msg(u'图片保存不成功 %s' % item['url'], level=log.WARNING)
                session.rollback()
        
        return item
        #for x in item:
        #    print x,item[x]
        #return item

        
