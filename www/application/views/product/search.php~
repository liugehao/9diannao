<div class="span9">
<br>
<div><h1><?php echo $category;?></h1></div>
<hr>
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
<script>
$(function(){
	$('#btnlist button a').parent().click(function(){
		location.href = $(this).children(0).attr('href');
		});
	
});
</script>