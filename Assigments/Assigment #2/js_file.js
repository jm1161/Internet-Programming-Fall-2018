//Problem 1
$("#wishes").text("I hate you, Bob.");

//Problem 2
$("#changeDucky img").attr("src","https://i.ytimg.com/vi/oMQI0bJJOvM/hqdefault.jpg")

//Problem 3
$("#imageResize img").css("width","300px")

//Problem 4
$("#clickAction button").click(function()
{
	$("#changeColor").css("color","red")
	$("#changeColor").css("font-size","200%")
});

//Problem 5
$("#secretVisible img").click(function () 
{
   	$("#revealSecret").attr("class", " ");
});

//Problem 6
$("#borderUnited img").hover(function () 
{
   	$(".menu").css("border-style", "solid");
   	$(".menu").css("border-width", "5px");
   	$(".menu").css("border-color", "yellow");
},function()
{
	$(".menu").css("border-style", "");
   	$(".menu").css("border-width", "");
   	$(".menu").css("border-color", "");
});

//Problem 7
$("#eavesDropping input").keyup(function(data)
{
	inputLine = data.target.value
	$("#outbox").val(inputLine)
});

//Problem 8
$("#focusMe input").focusout(function()
{
	$("#focusNot").val("HAHA")
});

//Problem 9
$("#jailBreak input").change(function()
{
	if($(this).prop("checked"))
	{
        $('#criminal').attr('disabled', 'disabled');
    } 
    else 
    {
        $('#criminal').removeAttr('disabled');
    }
});

//Problem 10
$("#dateFormater input").focusout(function(data)
{
	inputLine = data.target.value
	result = moment(inputLine).format("l")
	$("#userDateIn").val(result)
});