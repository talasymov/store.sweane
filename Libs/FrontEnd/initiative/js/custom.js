$(document).ready(function()
{
	var rotation;
	var message;
	
	rotation = $(".slider");
	console.log(rotation);
	rotation.slick({
	  dots: false,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  arrows: false,
	  focusOnSelect: false
	});
	rotation.off('click focus focusin focusout mousedown');
	rotation.unbind('click focus focusin focusout mousedown');
	message = $("#button_message");
	message.click(function ()
	{
		var currentItem;
		var form;
		var fields;
		var queryString = "";
		
		currentItem = $(this);
		
		form = $("#send_form")
		fields = form.children();
		fields.each(function (index)
		{
			var fieldItem;
			var data;
			
			fieldItem = $(this);
			data = fieldItem.val()
			if(data == undefined || data == "")
				data = fieldItem.html();
			queryString += fieldItem.attr("name") + "=" + data;
			queryString += "&";
		});
		queryString = queryString.substr(0, queryString.length - 1);
		$("#message_output").html("Ваше письмо успешно отправлено!");
		$.ajax(
		{
			type:"POST",
			url:"mailer.php",
			data:queryString,
			success:function(data, textStatus, requester)
			{
				var alert;
				console.log(data);
			}
		});
		console.log(queryString);
		
	})
	console.log(message);
	
});