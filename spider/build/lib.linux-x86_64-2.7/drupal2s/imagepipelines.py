from scrapy.contrib.pipeline.images import ImagesPipeline
import hashlib
from datetime import datetime
class MyImagesPipeline(ImagesPipeline):
    def image_key(self, url):
        image_guid = hashlib.sha1(url).hexdigest()
        #return 'full/%s.jpg' % (image_guid)
        path = datetime.now().strftime("%Y/%m/%d")
        return '%s/%s.jpg' % (path, image_guid)
