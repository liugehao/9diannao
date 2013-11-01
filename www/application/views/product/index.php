<div class="span9">
<br>
<div><h1>最新信息</h1></div>
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
</td>
<td class="span1"><a href="<?php echo base_url("product/{$p->id}");?>" target="_blank"><?php echo $p->price;?></a></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</div>
