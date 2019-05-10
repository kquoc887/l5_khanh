$(document).ready(function () {
    $('#form_signup').on('submit', function(event) {
        event.preventDefault();
        if($('#action_button').val() == 'Sign up') {
           $.ajax({
            url: route('users.store'),
            type: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(data,status) {
                refreshValidate();
                if (data.errors) {
                    checkValidate(data.errors);
                } 
                if (data.success) {
                    $('#form_result').html(data.success);
                    $('#form_signup')[0].reset();
                } else {
                    $('#form_result').html('');
                }
            }
        });
        }
        
    });


    
    $('#close, .close').on('click', function() {
      refreshValidate();
    });

    
    $(document).keyup(function(event) {
        if(event.keyCode == 27) {
            refreshValidate();
        }
    });

    $(document).mousedown(function(e) {
        if (e.button) {
            
        }
    })
    
});

function checkValidate(arrayError) {

    var arr = [];
    
    for(var i in arrayError) {
       arr[i] = arrayError[i];
       
    }

   for (var item in arr) {
        if (arr[item] != '') {
            $('#'+item+'_error').html(arr[item]);
        } else {
            $('#'+item+'_error').html('');
        }
   }
    
}

function refreshValidate() {
    var span_error = $('.form-group label>span');
    for (var index = 0; index < span_error.length; index++) {
        span_error[index].innerHTML = '';
     }
} 