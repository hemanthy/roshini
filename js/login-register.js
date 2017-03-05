/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}


$(".btn1").click(function(){
    $("#loginModalPlus").fadeIn();
});

function showLoginFormPlus(){
    alert("ok");

/*    $('#loginModalPlus .registerBoxPlus').fadeIn('fast',function(){
        alert("ok 12");
       // debugger;
        $('.loginBoxPlus').fadeOut('fast');
        $('.register-footerPlus').fadeIn('fast',function(){
            $('.login-footerPlus').fadeOut('fast');
        });

        $('.modal-titlePlus').html('Login with');
    });
    $('.alert').removeClass('alert-danger').html('');*/
}





function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
/* 
function loginAjax(){

    $.post( "/login", function( data ) {
            if(data == 1){
                window.location.replace("/home");            
            } else {
                 shakeModal(); 
            }
        });



} */
/*   Simulate error message from the server   */
/*     shakeModal(); */
function shakeModal(errormsg){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html(errormsg);
          //   $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

function hideModal() {
    setTimeout(function(){
        $('#loginModal').modal('hide');
    }, 230);
}

