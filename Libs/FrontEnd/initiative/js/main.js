"use strict";
$(document).ready(function(){
  $(".circle").click(function(){
    $("#img-" + $(this).attr("data-id")).css("transform", "scaleX(1)");
  });
  $(".port-bnt-right").click(function()
  {
    alert();
  });
  $(".port").click(function()
  {
    checkElementTopPosition($("#hp-3"), 1100, 140);
  });
  $(".about").click(function()
  {
    checkElementTopPosition($("#hp-4"), 1100, 0);
  });
  $(".whatwedo").click(function()
  {
    checkElementTopPosition($("#hp-2"), 1100, 0);
  });
  $(".ourpart").click(function()
  {
    checkElementTopPosition($("#hp-7"), 1100, 0);
  });
  $(".cont").click(function()
  {
    checkElementTopPosition($("#hp-5"), 1100, 0);
  });
  $(".show-port").click(function()
  {
    var id = $(this).attr("data-id");
    var lang = $(this).attr("data-lang");

    $.ajax({
      url: "/disp.php?command=show_port",
      method: "POST",
      type: "POST",
      data: {
        "id": id,
        "lang": lang
      },
      success: function(result){
        $("#show_port").css("visibility", "visible");
        $("#show_port_bg").css("visibility", "visible");
        $("body").css("overflow-y", "hidden");
        $("#show_port").html(result);
      }
    });
  });
  $("body").on("click", ".close-wind", function()
  {
    $("#show_port").css("visibility", "hidden");
    $("#show_port_bg").css("visibility", "hidden");
    $("body").css("overflow-y", "auto");
    $("#show_port").html("");
  });
  $(window).scroll(function(){
    showMenu();
  });
  $(".left-btn").click(function()
  {
    if($(this).attr("data-position") > 0)
    {
      $("#portfolio-home-div").fadeOut(500);
      var changePosition = parseInt($(this).attr("data-position")) - 1;
      var language = $(".select-lang-top").find(".text").html();

      $(this).attr("data-position", changePosition);
      $.ajax({
        url: "/disp.php?command=get_portfolio",
        method: "POST",
        type: "POST",
        data: {
          "changePosition": changePosition,
          "lang": language
        },
        success: function(result){
          setTimeout(function(){
            returnDiv(result);
          },500);
        }
      });
    }
  });
  $(".right-btn").click(function()
  {
    if($(".left-btn").attr("data-position") < 3)
    {
      $("#portfolio-home-div").fadeOut(500);
      var changePosition = parseInt($(".left-btn").attr("data-position")) + 1;
      var language = $(".select-lang-top").find(".text").html();
      $(".left-btn").attr("data-position", changePosition);
      $.ajax({
        url: "/disp.php?command=get_portfolio",
        method: "POST",
        type: "POST",
        data: {
          "changePosition": changePosition,
          "lang": language
        },
        success: function(result){
          setTimeout(function(){
            returnDiv(result);
          },500);
        }
      });
    }
  });
});
function returnDiv(result)
{
  $("#portfolio-home-div").html(result);
  $("#portfolio-home-div").fadeIn(5);
}
function sendForm()
{
  var name = $("#form_name").val();
  var secName = $("#form_sec_name").val();
  var email = $("#form_email").val();
  var message = $("#form_message").val();

  if(name == "" || secName == "" || email == "" || message == "")
  {
    alert("Не все поля заполнены!");
  }
  else
  {
    $.ajax({
      url: "/disp.php?command=send_form",
      method: "POST",
      type: "POST",
      data: {
        "name": name,
        "secName": secName,
        "email": email,
        "message": message
      },
      success: function(result){
        alert(result);
      }
    });
  }
}
function showMenu()
{
  if($(window).width() < 768)
  {
    if($(window).scrollTop() > 30){
      $("#menu-show").css("visibility","visible");
      $("#menu-show").css("top","0");
    }
    else {
      $("#menu-show").css("visibility", "hidden");
      $("#menu-show").css("top", "-70px");
      $("#menu-show").find("ul").hide();
      $("#menu-show").removeClass("big-m");
    }
  }
  else
  {
    if($(window).scrollTop() > 300){
      $("#menu-show").css("visibility","visible");
      $("#menu-show").css("top","0");
    }
    else {
      $("#menu-show").css("visibility", "hidden");
      $("#menu-show").css("top", "-70px");
    }
  }
}
function showMobi()
{
  $("#menu-show").find("ul").toggle();
  $("#menu-show").find(".select-lang-top").toggle();
  $("#menu-show").toggleClass("big-m");
}
function checkElementTopPosition(element, speed = 1100, top = 0) {
  var p = element;
  var offset = p.offset();
  $("#menu-show").find(".select-lang-top").hide();
  $('body').animate({ scrollTop: offset.top + top }, speed);
}
