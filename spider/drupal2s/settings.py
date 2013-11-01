#coding=utf-8
# Scrapy settings for drupal2s project
#
# For simplicity, this file contains only the most important settings by
# default. All the other settings are documented here:
#
#     http://doc.scrapy.org/topics/settings.html
#

BOT_NAME = 'drupal2s'

SPIDER_MODULES = ['drupal2s.spiders']
NEWSPIDER_MODULE = 'drupal2s.spiders'
IMAGES_STORE = '/var/www/files'
IMAGES_EXPIRES = 1
IMAGES_THUMBS = {
#    'small':(50, 50),
#    'big': (270, 270)
}
IMAGES_MIN_HEIGHT = 1
IMAGES_MIN_WIDTH = 1
ITEM_PIPELINES = [
                  #'scrapy.contrib.pipeline.images.ImagesPipeline',
                  'drupal2s.imagepipelines.MyImagesPipeline',
                  'drupal2s.pipelines.Drupal2SPipeline',]
# Crawl responsibly by identifying yourself (and your website) on the user-agent
#USER_AGENT = 'drupal2s (+http://www.yourdomain.com)'



import os

BOT_VERSION = '1.0'
LOG_LEVEL = 'INFO' #CRITICAL, ERROR, WARNING, INFO, DEBUG

USER_AGENT = '%s/%s' % (BOT_NAME, BOT_VERSION)
#ITEM_PIPELINES = ['drupal2s.pipelines.Drupal2SPipeline']
LOG_FILE = './crawl.log'
DUPEFILTER_CLASS = 'androidscrapy.RFPDupeFilter.RFPDupeFilter'
DUPEFILTER_CLASS = 'scrapy.dupefilter.RFPDupeFilter'
DEPTH_PRIORITY = 1
SCHEDULER = 'scrapy.core.scheduler.Scheduler'
SCHEDULER_DISK_QUEUE = 'scrapy.squeue.PickleLifoDiskQueue'
SCHEDULER_MEMORY_QUEUE = 'scrapy.squeue.LifoMemoryQueue'
#SCHEDULER_PERSIST = True
DOWNLOAD_DELAY = 4
DOWNLOAD_TIMEOUT = 7200
CONCURRENT_REQUESTS = 20
JOBDIR = '/root/spider/job' #坑啊，官方手册中没有这个
#JOBDIR = '/tmp1'
"""
def setup_django_env(path):
    import imp, os
    from django.core.management import setup_environ

    f, filename, desc = imp.find_module('settings', [path])
    project = imp.load_module('settings', f, filename, desc)

    setup_environ(project)
    import sys
    sys.path.append(os.path.abspath(os.path.join(path, os.path.pardir)))

current_dir = os.path.abspath(os.path.dirname(os.path.dirname(__file__)))
setup_django_env(os.path.join(current_dir, '../android/android/'))
"""
