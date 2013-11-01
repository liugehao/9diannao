<div class="span9">
<form class="form-horizontal" method="post" id="registerform">
  <fieldset>
    <legend>用户注册</legend>
    
    <div class="control-group">
        <label class="control-label" for="title">用户名</label>
        <div class="controls">
        <input type="text" id="title" placeholder="title" name="title" length="20">
        <span class="help-inline">*</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="pwd">密码</label>
        <div class="controls">
        <input type="password" id="pwd" placeholder="密码" name="pwd">
        <span class="help-inline">*</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="pwd1">重复密码</label>
        <div class="controls">
        <input type="password" id="pwd1" placeholder="密码" name="pwd1">
        <span class="help-inline">*</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
        <input type="text" id="email" placeholder="售价" name="email" class="span3">
        <span class="help-inline">*</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="contact">联系人</label>
        <div class="controls">
        <input type="text" id="contact" placeholder="联系人" name="contact" length="20">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="phone">电话</label>
        <div class="controls">
        <input type="text" id="phone" placeholder="电话" name="phone" length="30">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="county">地址</label>
        <div class="controls">
        <select name="province" class="span2" id="province">
        </select>
       <select name="city" class="span2" id="city">
        </select>
        <select name="county" class="span2" id="county">
        </select> <input type="text" id="address" placeholder="address" name="address" length="30">
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
<script src="/static/js/prov_city_county.js" type="text/javascript"></script>
<script type="text/javascript" >

$(function(){


    $('#username, #pwd, #pwd1, #email').focusout(function(){
        if($(this).val()=='') $(this).parent().parent().addClass('warning');
        else $(this).parent().parent().removeClass('warning');
    });

    
    $('#registerform').submit(function(){
        var submit ;
        $.each(Array('#pwd', '#pwd1', '#username', '#email'), function(i,item){
            if($(item).val()==''){
                $(item).parent().parent().addClass('warning');
                submit = false;
            }
        });
        if(!submit)
            return submit;
        
        if($('#pwd1').val()!=$('#pwd').val()){
            $('#pwd1, #pwd').parent().parent().addClass('warning');
            return false;
        }
    });
});
</script>
