function area(selectid, pid){
$.getJSON('/index.php/area/ajax?pid='+pid, function(json){
        $('#'+selectid).html('<option value="0">--请选择--</option>');
        $.each(json, function(i,data){
            $('#'+selectid).append('<option value="'+data.id+'">'+data.name+'</option>');
        });
    });
}

    $('#county, #city').html('<option value="0">--请选择--</option>');
	area('province', '0')
    $('#province').change(function () {
        var pid = $(this).val();
	    if(pid == '0'){$('#city').html('<option value="0">--请选择城市--</option>');}
        else{
            area('city', pid);
        }
        
    });
    $('#city').change(function () {
        var pid = $(this).val();
	    if(pid == '0'){$('#county').html('<option value="0">--请选择区/县--</option>');}
        else{
            area('county', pid);
        }
    });
