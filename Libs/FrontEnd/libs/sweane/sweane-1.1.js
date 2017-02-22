$(document).ready(
  function()
  {
    $("body").on(".selector-default span", "click", function()
    {
      $(this).find("ul").show();
    });
    $(".select-default").find("span").click(function()
    {
      $(this).parents(".select-default").find("ul").toggle();
    });
    $(".selector-default").find("span").click(function()
    {
      var div = $("<div>");
      var ul = $("<ul>");
      ul.append($(this).parents(".selector-default").find("ul").html());
      div.attr("class", "modal-selector")
      div.html(ul);
      $("body").append(div);
    });

    $("#menu-show").click(function()
    {
      $(this).hide();
      $("#menu-hide").show();
    });
    $("#menu-hide").click(function()
    {
      $("#menu-hide").hide();
      $("#menu-show").show();
    });
  }
);
