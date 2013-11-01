<div class="span3 bs-docs-sidebar">
<ul class="nav nav-list bs-docs-sidenav  nav-pills nav-stacked"> 
<?php if(!$this->session->userdata('uid')):?>

<li>
<div class="control-group">
<form method="post" action="<?php echo base_url('user/login');?>">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
    <input type="text" id="inputEmail" placeholder="Email 或者 用户名" name="username">
    </div>
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    <input type="password" id="inputPassword" placeholder="Password" name="pwd">
    </div>
    <div class="controls">

    <button type="submit" class="btn">登　录</button>
    </div></form>
    </div>
    </li>
                
<li><a href="<?php echo base_url('user/register');?>"><i class="icon-chevron-right"></i>没有注册?　　现在注册！</a></li>
                

<?php else:?>
     
<li><a href="<?php echo base_url('product/add');?>"><i class="icon-chevron-right"></i>发布信息</a></li>
<li><a href="<?php echo base_url('mine');?>"><i class="icon-chevron-right"></i>我发布的信息</a></li>
<li><a href="<?php echo base_url('user/logout');?>"><i class="icon-chevron-right"></i>注销登录</a></li>


<li>

</li>         
<?php endif;?>
</ul>
<br>
   <br>
    <div class="input-append">
    <input class="span2"  type="text" id="titlesearch">
    <button class="btn" type="button" id="navbtnsearch">搜索</button>
    </div>

</div>
<script>
   $('#navbtnsearch').click(function(){
       location.href = '<?php echo base_url('product/search');?>?title='+$('#titlesearch').val();
});
</script>