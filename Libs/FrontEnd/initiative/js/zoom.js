$(document).ready(function(){
            $('.showport-mini img').click(function(){
                if($(window).width()>960){
                    $('.img-sh').find('img').attr("src",$(this).attr("src"));
                    setTimeout(funcd,1000);
                }
            });
            function funcd(){
                var width = $('.img-sh').find('img').width();
                var height = $('.img-sh').find('img').height();

                $('.img-sh').find('img').css("margin-left","-"+width/2+"px");
                $('.img-sh').find('img').css("margin-top","-"+height/2+"px");

                $('.img-sh img').show();
                $('.bg-red').show();
            }
            $('.bg-red').click(function(){
                $(this).hide();
                $('.img-sh img').hide();
            });

        });