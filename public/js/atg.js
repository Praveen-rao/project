$(function(){
    $('#userform').submit(function(e)
    {
        // alert("HEllo");
        var route = $('#userform').data('route');
        var form_data = $(this);
        $('.alert').remove();
        $.ajax({
            type: "POST",
            url : route,
            data : form_data.serialize(),
            success : function(response)
            {
                 // alert(respone['status'],respone['error']);
                if(response['status']==1)
                $('#messages').append('<p class="alert alert-success">'+response['error']+'</p>');
                else if(response['error']['duplicate']==1){
                            
                        $('#messages').append('<p class="alert alert-danger">record already exists in database!</p>');
                }
                else{
                        for (const err of response['error']) {
                            for (const key in err) {
                                $('#messages').append('<p class="alert alert-danger">'+err[key]+'</p>');
                            }
                            
                        }
                }
            }
        }
        );
        e.preventDefault();
    });
});