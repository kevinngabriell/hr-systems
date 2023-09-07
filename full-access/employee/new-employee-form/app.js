$(document).on('change', '#user_department', function(){
    var department_id = $(this).val();
    if(department_id){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'department_id': department_id},
            success:function(result){
                $('#user_position').html(result);
            }
        })
    } else {
        $('#user_position').html('<option value="">Pilih jabatan</option>')
    }
})

$(document).on('change', '#user_province_ktp', function(){
    var province_ktp = $(this).val();
    if(province_ktp){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'province_ktp': province_ktp},
            success:function(result){
                $('#user_city_ktp').html(result);
            }
        })
    }
})

$(document).on('change', '#user_city_ktp', function(){
    var city_ktp = $(this).val();
    if(city_ktp){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'city_ktp': city_ktp},
            success:function(result){
                $('#user_kec_ktp').html(result);
            }
        })
    }
})

$(document).on('change', '#user_kec_ktp', function(){
    var kec_ktp = $(this).val();
    if(kec_ktp){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'kec_ktp': kec_ktp},
            success:function(result){
                $('#user_kel_ktp').html(result);
            }
        })
    }
})

$(document).on('change', '#user_province_now', function(){
    var province_now = $(this).val();
    if(province_now){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'province_now': province_now},
            success:function(result){
                $('#user_city_now').html(result);
            }
        })
    }
})

$(document).on('change', '#user_city_now', function(){
    var city_now = $(this).val();
    if(city_now){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'city_now': city_now},
            success:function(result){
                $('#user_kec_now').html(result);
            }
        })
    }
})

$(document).on('change', '#user_kec_now', function(){
    var kec_now = $(this).val();
    if(kec_now){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'kec_now': kec_now},
            success:function(result){
                $('#user_kel_now').html(result);
            }
        })
    }
})


