from sqlalchemy import create_engine
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy import Column, String, Integer, Text, DateTime
from sqlalchemy import Sequence

Base = declarative_base()

engine = create_engine('postgresql://lj2s:liuyou77@localhost/lj2s')
class Product(Base):
    __tablename__ = "products"
    id = Column(Integer, Sequence('product_id_seq'), primary_key=True)
    title = Column(String)
    body = Column(Text)
    created = Column(DateTime)
    phone = Column(String(30))
    contact = Column(String(20))
    province = Column(Integer)
    city = Column(Integer)
    county = Column(Integer)
    price = Column(Integer)
    category = Column(Integer)
    address = Column(String(20))
    

class Area(Base):
    __tablename__ = 'areas'
    id = Column(Integer, primary_key=True)
    name = Column(String(20))
    pid = Column(Integer)
    
class Myfile(Base):
    __tablename__ = 'myfiles'
    id = Column(Integer, Sequence('myfiles_id_seq'), primary_key=True)
    product_id = Column(Integer)
    path = Column(String(255))


Base.metadata.create_all(engine)
from sqlalchemy.orm import sessionmaker
Session = sessionmaker(bind=engine)
session = Session()
