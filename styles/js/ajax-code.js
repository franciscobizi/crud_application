// Authentication
$("#signin").click(function(){
 
    var mail = $("#mail").val();
    var pass = $("#pass").val();
                            
    $.ajax({
                                
        method: 'POST',
        url: 'http://localhost/crud_application/signin',
        dataType: 'json',
        data: {mail: mail, pass: pass},
        success: function(data){
            var field = data['resp'];
            var msg = data['msg'];
                                                                        
            switch(field){
                                                
                case 'yes':
                    window.location="http://localhost/crud_application/user";
                break;
                case 'no':
                    $("#result").removeClass('text-success');
                    $("#result").addClass('text-danger text-center').text(msg);
                                
                break;
                default:
                                                   
            }
                                          
       }
    });
});

