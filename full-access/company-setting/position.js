$(document).on('change', '#company_id', function(){
    var company_id = $(this).val();
    if(company_id){
        $.ajax({
            type: 'POST',
            url: 'getuserdata.php',
            data: {'company_id': company_id},
            success:function(result){
                $('#department_id').html(result);
            }
        })
    }
})