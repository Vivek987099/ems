import './bootstrap';




$(document).ready(function(){
    
    $('#toggle-password').on('click',function(){
        let inputPassword = $('#password')
        if(inputPassword.attr('type')==='password'){
            inputPassword.attr('type','text')
            $(this).removeClass('fa-eye').addClass('fa-eye-slash')
        }else{
            inputPassword.attr('type','password')
            $(this).removeClass('fa-eye-slash').addClass('fa-eye')
        }
    })
   
   $('#loginform').submit(function(e){
    e.preventDefault()
    $.ajax({
        url: "/api/login",
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
            if(response.status){
                localStorage.setItem('token',response.token)
                window.location.href = '/employees'
            }
        },
        error: function(xhr){
            alert(xhr.responseJSON.message);
        }
    });
   })
})
