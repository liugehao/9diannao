<div class="span9">
<br>
<div><h1></h1></div>
<hr>
<form class="form-horizontal" method="get"  enctype="multipart/form-data">
  <fieldset>
    <legend>高级搜索</legend>
    
    <div class="control-group">
        <label class="control-label" for="title">内容</label>
        <div class="controls">
        <input type="text" id="title" placeholder="请输入想要搜索的内容,尽量简短" name="title">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="category">分类</label>
        <div class="controls">
        <select name="category" class="span2">
        <option value="0">--请选择分类--</option>
        <?php foreach($categories->result() as $c):?>
        <option value="<?php echo $c->id;?>"><?php echo $c->title;?></option>
        <?php endforeach;?>        
        </select> 
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="price">售价</label>
        <div class="controls">
        <input type="text" id="price" placeholder="售价" name="price" class="span1">元　-
        <input type="text" id="price" placeholder="售价" name="price1" class="span1"> 元
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="county">地址</label>
        <div class="controls">
        <select name="province" class="span2" id="province">
        </select> - 
       <select name="city" class="span2" id="city"> - 
        </select>
        <select name="county" class="span2" id="county"> - 
        </select> 
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

<table class="table table-striped">
<thead>
<tr>
<th>发布时间</th>
<th>标题</th>
<th>价格</th>
</tr>
</thead>
<tbody>
<?php foreach($products as $p):?>
<tr>
<td class="span3"><?php echo $p->created;?></td>
<td><a href="<?php echo base_url("product/{$p->id}");?>" target="_blank"><?php echo $p->title;?></a>
<?php if(strpos($_SERVER['REQUEST_URI'], 'mine') !== false && $p->userid == $this->session->userdata('uid')): ?>
[<a href="<?php echo base_url("product/edit/{$p->id}");?>">编辑</a>]
<?php endif;?>
</td>
<td class="span1"><a href="<?php echo base_url("product/{$p->id}");?>" target="_blank"><?php echo $p->price;?></a></td>
</tr>
<?php endforeach;?>
</tbody>
<tfoot>
<tr>
<td colspan="3"><div class="btn-toolbar">
  <div class="btn-group" id="btnlist"><?php echo $pagelist;?>
  </div>
  </div></td>
</tr>
</tfoot>
</table>
</div>
<script src="/static/js/prov_city_county.js" type="text/javascript"></script>
<script type="text/javascript" >
$(function(){

    
    $('#addfile').click(function(){
		$(this).after('<input type="file" class="span3 file" name="file[]" >');
		return false;
        });
    $('#btnlist button a').parent().click(function(){
		location.href = $(this).children(0).attr('href');
		});
	
});
</script>