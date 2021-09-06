$(function(){
var textfield = $("input[name=user]");
            $('button[type="submit"]').click(function(e) {
                e.preventDefault();
                //little validation just to check username
                if (textfield.val() != "") {
                    //$("body").scrollTo("#output");
                    $("#output").addClass("alert alert-success animated fadeInUp").html("Добро пожаловать " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");
                    $("#output").removeClass(' alert-danger');
                    $("input").css({
                    "height":"0",
                    "padding":"0",
                    "margin":"0",
                    "opacity":"0"
                    });
                    //change button text 
                    $('button[type="submit"]').html("Продолжить")
                    .removeClass("btn-info")
                    .addClass("btn-default").click(function(){
                   $("input").css({
                   "height":"auto",
                   "padding":"10px",
                   "opacity":"1"
                   }).val("");
                   });


                    //$(form).attr('acction','<a href="forma.html">Продолжить</a>');
                   //$('<a href="forma.html">Продолжить</a>').insertAfter($(this));
                   //$(this).hide();
                    
                    //show avatar
                    $(".avatar").css({
                        "background-image": "url('http://api.randomuser.me/0.3.2/portraits/women/35.jpg')"
                    });
                } else {
                    //remove success mesage replaced with error message
                    $("#output").removeClass(' alert alert-success');
                    $("#output").addClass("alert alert-danger animated fadeInUp").html("Напишите логин");
                }
                //console.log(textfield.val());

            });
});