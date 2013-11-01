# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/topics/items.html

from scrapy.item import Item, Field

class Drupal2SItem(Item):
    # define the fields for your item here like:
    url = Field()
    title = Field()
    body = Field()
    category = Field()
    price = Field()
    phone = Field()
    county = Field()
    city = Field()
    created = Field()
    contact = Field()
    address = Field()
    image_urls = Field()
    image_paths = Field()
    images = Field()

