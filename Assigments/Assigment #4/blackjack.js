///////////////////Global Variables///////////////////////

var FILE_PATH = "images/CARD_NAME.png"
var card_template = $("#card_template")
var dealer_hand = $("#dealer_hand").children().eq(0)
var player_hand = $("#player_hand").children().eq(0)

var dealer_points = 0
var player_points = 0
var bankroll = 500000
var hidden = true

var deck = ["2C","2D","2H","2S",
			"3C","3D","3H","3S",
			"4C","4D","4H","4S",
			"5C","5D","5H","5S",
			"6C","6D","6H","6S",
			"7C","7D","7H","7S",
			"8C","8D","8H","8S",
			"9C","9D","9H","9S",
			"AC","AD","AH","AS",
			"JC","JD","JH","JS",
			"KC","KD","KH","KS",
			"QC","QD","QH","QS",
			"TC","TD","TH","TS"]

$(".fa-plus").attr("disabled", true)
$(".fa-check").attr("disabled", true)

//////////////////////////////////////////////////////////

function image_filePath(card_name) 
{
	return FILE_PATH.replace("CARD_NAME",card_name)
}

function add_card(hand_ID,hand)
{

	if(hand_ID == "dealer_hidden")
	{
		//display the upside down card
		add = card_template.clone()	
		add.attr("src",image_filePath("cardback"))
		add.removeAttr("id")
		hand.append(add).fadeOut().fadeIn()

		//store the value of the hidden card and hidde it
		add = card_template.clone()
		card_name = shuffle_cards()
		slice = card_name[0]

		//check if the card is an ace(11 or 1)
		if(slice == "A" && player_points > 10)
		{
			dealer_points += 1
		}
		else
		{
			dealer_points += card_value(card_name) 
		}
		add.attr("src",image_filePath(card_name))
		add.attr("hidden",true)
		add.removeAttr("id")
		hand.append(add).fadeOut().fadeIn()	
	}
	else if(hand_ID == "dealer_hand")
	{
		//add cards normally to the hand and 
		//check if card is an ace(11 or 1)
		add = card_template.clone()		
		card_name = shuffle_cards()
		slice = card_name[0]
		if(slice == "A" && player_points > 10)
		{
			dealer_points += 1
		}
		else
		{
			dealer_points += card_value(card_name) 
		}
		add.attr("src",image_filePath(card_name))
		add.removeAttr("id")
		hand.append(add).fadeOut().fadeIn()		
	}
	else if(hand_ID == "player_hand")
	{
		//add cards normally to the hand and 
		//check if card is an ace(11 or 1)
		add = card_template.clone()
		card_name = shuffle_cards()
		slice = card_name[0]
		if(slice == "A" && player_points > 10)
		{
			player_points += 1
		}
		else
		{
			player_points += card_value(card_name) 
		}
		add.attr("src",image_filePath(card_name))
		add.removeAttr("id")
		hand.append(add).fadeOut().fadeIn()
	}
}
function card_value(card_name) 
{
	slice = card_name[0]
	if(slice == "A") return 11
	if(slice == "K" || slice == "Q" ||
	   slice == "J" || slice == "T") return 10
	else return parseInt(slice)
}
function shuffle_cards()
{
	return deck[Math.floor(Math.random()*deck.length)]
}
function check_winner()
{
	if(dealer_points > 21)
	{
		message = "Congratulation you win!"
		icon = "success"
		bankroll += (player_bet * 2)
		$("span").text(bankroll.toLocaleString())
	}
	else if(dealer_points < player_points)
	{
		message = "Congratulation you win!"
		icon = "success"
		bankroll += (player_bet * 2)
		$("span").text(bankroll.toLocaleString())
	}
	else if(dealer_points > player_points)
	{
		message = "Awwww you lost!"
		icon = "info"
	}
	else if(dealer_points == player_points)
	{
		message =  "IT'S A TIE!"
		icon = "warning"
	}
		playAgain(message,icon)
}

function playAgain(message,icon)
{
	swal(message, "Do you want to play again?", icon,
	{
		buttons: 
		{
		  yes: 
		  {
		    text: "Yes",
		    value: true,
		    visible: true,
		    className: "",
		    closeModal: true,
		  },
		  no: 
		  {
		    text: "No",
		    value: null,
		    visible: true,
		    className: "",
		    closeModal: true
		  }
		}
	}).then((value) => 
	{
		if(value)
		{
			$("input").show()
			$("#deal_button").show()
			$(".fa-plus").attr("disabled", true)
			$(".fa-check").attr("disabled", true)
			dealer_points = 0
			player_points = 0
			hidden = true
		}
		else
		{
			$(".fa-plus").attr("disabled", true)
			$(".fa-check").attr("disabled", true)	
		}
	});
}

//Check if the deal button is clicked
$("#deal_button").click( function()
{
	$(".fa-plus").removeAttr("disabled")
	$(".fa-check").removeAttr("disabled")

	//extract the content of the input textbox
	player_bet = $("input").val()

	//check if you have enough money to bet
	if(player_bet <= bankroll && player_bet != 0) // enough money
	{
		//deduct the amount from the total money you have
		bankroll = bankroll - player_bet
		$("span").text(bankroll.toLocaleString())

		//make sure the user cannot make anymore bets by removing
		//the deal button and textbox
		$("input").hide()
		$("#deal_button").hide()

		//the dealer and player hands starts empty remove the pictures
		$("#dealer_hand").find("img").remove()
		$("#player_hand").find("img").remove()

		//dealer needs to have 2 cards(1 face up, 1 faced down)
		add_card("dealer_hidden", dealer_hand)
		add_card("dealer_hand", dealer_hand)

		//player needs to have 2 cards(2 face up)
		add_card("player_hand", player_hand)
		add_card("player_hand", player_hand)
	}
	else if(player_bet == 0) //Player made a 0 bet
	{
		swal("You cannot cheat the system!!", "You need to bet money!!", "error")
	}
	else //not enough money
	{
		swal("Sorry pal, you do not have enough money!", "", "info")
	}
	return false;
})

	//player chooses to "Hit" or "Stand"
	//if "Hit" add another card to the player hand, and check if
	//the number goes over 21 they loose

$(".fa-plus").click(function()
{
	add_card("player_hand",player_hand)
	if(player_points > 21)
	{
		message = "Awww you lost you went over 21"
		icon = "info"

		setTimeout(function()
		{
			playAgain(message,icon)
		}, 1500)
	}
})

	//if "Stand" show the dealer hidden card, keep adding cards until 
	//the dealer hand reaches 17
$(".fa-check").click(function()
{
	$(".fa-plus").attr("disabled", true)
	$("#dealer_hand").find("[src = 'images/cardback.png']").remove()
	$("#dealer_hand").find("[hidden = hidden]").removeAttr("hidden")

	if(!hidden && dealer_points < 17)
	{
		add_card("dealer_hand",dealer_hand)
	}

	if(dealer_points > 16)
	{
		setTimeout(function()
		{
			check_winner()
		}, 1500)
	}
	hidden = false
})


