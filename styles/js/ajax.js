$("#submit").click(function(){

    $("#ok-success").text("Esta funcionar");
    /*var mail = $("#mail").val();
    var passw = $("#passwd").val();
                
    $.ajax({
                    
        method: 'POST',
        url: 'http://localhost/new-app/auth',
        dataType: 'json',
        data: {mail: mail, passw: passw},
        success: function(data){
            var field = data['field'];
            var msg = data['msg'];
                                                            
            switch(field){
                                    
                case 'email':
                    $("#not-autorized").text(msg);
                break;
                case 'success':
                    $("#ok-success").text(msg);
                    //window.location="http://localhost/gm/myprofile";
                break;
                default:
                                       
            }
                              
        }
    });*/
});

$("#recoverpass").click(function(){
    var mail = $("#e-mail").val();
    $.ajax({
                    
            method: 'POST',
            url: 'http://localhost/app-m/reset_pass',
            dataType: 'json',
            data: {mail: mail},
            success: function(data){
                var field = data['field'];
                var msg = data['msg'];
                                                      
                    switch(field){
                                
                        case 'empty':
                            $("#recover-result").removeClass('text-success');
                            $("#recover-result").removeClass('text-warning');
                            $("#recover-result").addClass('text-danger text-center').text(msg);  
                        break;
                        case 'notfound':
                            $("#recover-result").removeClass('text-danger');
                            $("#recover-result").removeClass('text-success');
                            $("#recover-result").addClass('text-warning text-center').text(msg);
                        break;
                        case 'ok':
                            $("#recover-result").removeClass('text-danger');
                            $("#recover-result").removeClass('text-warning');
                            $("#recover-result").addClass('text-success text-center').text(msg);
                            $("#recoverpass").addClass('disabled');
                        break;
                        default:
                                   
                    }        
            }
        })
});
            
            $("#sign-btn").click(function(){
                var email = $("#email").val();
                var pass = $("#password").val();
                var rule = $("#rule").val();
                var name = $("#name").val();
                var fone = $("#fone").val();
              
                $.ajax({
                    
                    method: 'POST',
                    url: 'http://localhost/guidehand/signup',
                    dataType: 'json',
                    data: {name: name, email: email, password: pass, fone: fone, rule: rule},
                    success: function(data){
                        
                            var field = data['field'];
                            var msg = data['msg'];
                                                      
                            switch(field){
                                
                                case 'empty':
                                    $("#ajax-result").removeClass('text-white');
                                    $("#ajax-result").removeClass('text-warning');
                                    $("#ajax-result").addClass('text-danger text-center').text(msg);  
                                break;
                                case 'email':
                                    $("#ajax-result").removeClass('text-white');
                                    $("#ajax-result").removeClass('text-danger');
                                    $("#ajax-result").addClass('text-warning text-center').text(msg);
                                break;
                                case 'success':
                                    $("#ajax-result").removeClass('text-warning');
                                    $("#ajax-result").removeClass('text-danger');
                                    $("#ajax-result").addClass('text-white text-center').text(msg);
                                break;
                                default:
                                   
                            }
                          
                    }
                });
            });

            
            $("#sig-btn").click(function(){
                var mail = $("#mail").val();
                var passw = $("#pass").val();
                
                $.ajax({
                    
                    method: 'POST',
                    url: 'http://localhost/gm/auth',
                    dataType: 'json',
                    data: {mail: mail, passw: passw},
                    success: function(data){
                        
                            var field = data['field'];
                            var msg = data['msg'];
                                                        
                            switch(field){
                                
                                case 'empty':
                                    $("#e-result").text(msg);
                                break;
                                case 'email':
                                    $("#e-result").text(msg);
                                break;
                                case 'success':
                                    window.location="http://localhost/gm/myprofile";
                                break;
                                default:
                                   
                            }
                          
                    }
                });
            });
        
// NEW APPP STARTING HERE
$("#reset").click(function(){

    
    var mail = $("#mail").val();
                
    $.ajax({
                    
        method: 'POST',
        url: 'http://api-taylor/reset-passw',
        dataType: 'json',
        data: {mail: mail},
        success: function(data){
            var field = data['resp'];
            var msg = data['msg'];
                                                            
            switch(field){
                                    
                case 'yes':
                    $("#result").text(msg);
                break;
                case 'no':
                    $("#result").text(msg);
                    
                break;
                default:
                                       
            }
                              
        }
    });
});       
        //$("body").load(function(){
               // var id = 1;//$("#iduser").val();
$(document).ready(function(){
	
		type:'post',	       
                $.ajax({
                    method: 'POST',
                    url: 'http://localhost/guidehand/profile',
                    dataType: 'json',
                    //data: {id: id},
                    success: function(data){
                      
                        $("#name").val('Francisco');
                        $("#city").val(data['city']);
                        $("#fone").val(data['fone']);
                        $("#birth").val(data['birth']);  
                         
                    }
                });
 });
        
        $("body").load(function(){
                var name = $("#name").val();
                var city = $("#city").val();
                var fone = $("#fone").val();
                var birth = $("#birth").val();
 
                $.ajax({
                    method: 'POST',
                    url: 'http://localhost/guidehand/profile',
                    dataType: 'json',
                    data: {name: name, city: city, fone: fone, birth: birth},
                    success: function(data){
                      
                        $("#name").val();
                        $("#city").val();
                        $("#fone").val();
                        $("#birth").val();  
                         
                    }
                });
        });