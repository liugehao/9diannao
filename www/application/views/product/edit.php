<link href="/static/third-party/jQuery-UI-FileInput/css/enhanced.css" rel="Stylesheet">
<div class="span9">
<form class="form-horizontal" method="post"  enctype="multipart/form-data">
  <fieldset>
    <legend>编辑信息</legend>
    
    <div class="control-group">
        <label class="control-label" for="title">标题</label>
        <div class="controls">
        <input type="text" id="title" placeholder="title" name="title" value="<?php echo $product->title;?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="category">分类</label>
        <div class="controls">
        <select name="category" class="span2">
        <option>--请选择分类--</option>
        <?php foreach($categories->result() as $c):?>
        <option value="<?php echo $c->id;?>"><?php echo $c->title;?></option>
        <?php endforeach;?>
        </select> 
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="price">售价</label>
        <div class="controls">
        <input type="text" id="price" placeholder="售价" name="price" class="span1" value="<?php echo $product->price;?>">元
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="contact">联系人</label>
        <div class="controls">
        <input type="text" id="contact" placeholder="contact" name="contact" value="<?php echo $product->contact;?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="phone">电话</label>
        <div class="controls">
        <input type="text" id="phone" phone="title" name="phone" value="<?php echo $product->phone;?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="county">地址</label>
        <div class="controls">
        <select name="province" class="span2" id="province">
        <option value="0">--请选择--</option>
        <?php foreach($province as $p):?>
        <option value="<?php echo $p->id;?>" <?php if($p->id==$product->province) echo 'selected'?>><?php echo $p->name;?></option>
        <?php endforeach;?>
        </select> 
       <select name="city" class="span2" id="city">
        <option value="0">--请选择--</option>
        <?php foreach($city as $p):?>
        <option value="<?php echo $p->id;?>" <?php if($p->id==$product->city) echo 'selected'?>><?php echo $p->name;?></option>
        <?php endforeach;?>
        </select>
        <select name="county" class="span2" id="county">
        <option value="0">--请选择--</option>
        <?php foreach($county as $p):?>
        <option value="<?php echo $p->id;?>" <?php if($p->id==$product->county) echo 'selected'?>><?php echo $p->name;?></option>
        <?php endforeach;?>
        </select> <input type="text" id="address" placeholder="address" name="address" value="<?php echo $product->address;?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputtitle">详细内容</label>
        <div class="controls">
        <textarea id="body" placeholder="body" name="body" rows="4" class="span5"><?php echo $product->body;?>"</textarea>
        </div>
    </div>
	<div class="control-group" >
        <label class="control-label" for="Myfile">图片</label>
        
		<div class="controls" id="addfilediv">
		<input type="file" class="span3 file" name="file[]" id="file">
		<button id="addfile" class="btn btn-inverse">增加上传文件</button>
		</div>
  
    </div>
    <div class="control-group">
        <label class="control-label" for="address"></label>
        <div class="controls">
        <button class="btn btn-primary" role="button" aria-disabled="false"><span class="ui-button-text">提　交</span></button>
        </div>
    </div>
    
  </fieldset>
</form>
</div>  
<script src="/static/third-party/jQuery-UI-FileInput/js/fileinput.jquery.js" type="text/javascript"></script>
<script src="/static/js/prov_city_county.js" type="text/javascript"></script>
<script type="text/javascript" >
$(function(){
    $('#addfile').click(function(){
		$(this).after('<input type="file" class="span3 file" name="file[]" >');
		return false;
        });
});
</script>     
