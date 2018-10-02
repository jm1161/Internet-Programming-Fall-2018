//////////////// Global Variables ////////////

var load_catJSON = false
var load_dogJSON = false
var load_fireJSON = false
var displayResultsFlag = false
var numberOfkeywords = 0
var listOfResults = []

//////////////////////////////////////////////

///////// Functions /////////////////////////

function parseString(userInput)
{
	//Match the user's input to any of the 'database' keywords available
	if(userInput.match("cat"))
	{
		load_catJSON = true
		displayResultsFlag = true
		numberOfkeywords++
	}
	if(userInput.match("dog"))
	{
		load_dogJSON = true
		displayResultsFlag = true
		numberOfkeywords++
	}
	if(userInput.match("firetruck"))
	{
		load_fireJSON = true
		displayResultsFlag = true
		numberOfkeywords++
	}
}

function performAJAXrequest() 
{
	//if keyword is 'cat'
	if(load_catJSON)
	{
		$.ajax({url:"cat.json",async:false}).done(function(resultsArr)
		{
			addResults(resultsArr)
		})
	}

	//if keyword is 'dog'
	if(load_dogJSON)
	{
		$.ajax({url:"dog.json",async:false}).done(function(resultsArr)
		{
			addResults(resultsArr)	
		})
	}

	//if keyword is 'firetruck'
	if(load_fireJSON)
	{
		$.ajax({url:"firetrucks.json", async:false}).done(function(resultsArr)
		{
			addResults(resultsArr)
		})
	}
}

function addResults(resultsArr) 
{
	resultsArr.forEach(function(record) //adds the results into a single array for easy processing
	{
		listOfResults.push(record)
	})
	
}

function sortItems(by_category)
{
	
	if(by_category == "relevance")	//Sort it by relevance number (Descending order)
	{
		listOfResults.sort(function(a,b)
   		{
    		return b.relevance - a.relevance
   		})
	}
	else //sort it by title,url or excerpt either works 
	{
	   	listOfResults.sort(function(a,b)
	   	{
	   		var nameA = a[by_category].toUpperCase(); // ignore upper and lowercase
  			var nameB = b[by_category].toUpperCase(); // ignore upper and lowercase
  			if (nameA < nameB) 
  			{
    			return -1;
  			}
  			if (nameA > nameB) 
  			{
    			return 1;
  			}
  			return 0;
	   	})
	}
}

function searchDuplicates()
{
	sortItems("title") //sort the list of results by title so its easy to check for duplicates by title
	for(i = 0 ; i < listOfResults.length - 1; i++)
	{
		if(listOfResults[i].title == listOfResults[i+1].title)
		{
			listOfResults[i+1].relevance += listOfResults[i].relevance // add the relevance of the duplicate results to the current one 
			listOfResults.splice(i,1)	//delete the repeated duplicate
			i=0 // reset the index to double check the list is clean
		}
	}
}

function displayResults()
{
	sortItems("relevance") // sort the items by relevance once all duplicates have been taken care of.
	$("#result_panel").html("") 
	$("#results").remove() 

	listOfResults.forEach(function(element)
	{	
		result_template = $("#result_template").clone()
		result_template.removeAttr("id")
		result_template.find(".result_title").attr("href",element.url)
		result_template.find(".result_title").text(element.title)
		result_template.find(".result_url").text(element.url)
		result_template.find(".result_relevance").text("Relevance: "+ element.relevance)
		result_template.find(".result_excerpt").text(element.excerpt.substring(0,200)+ "....")
		$("#result_panel").append(result_template)
	})

}
function displayNoResults()
{
	$("#results").remove()
	swal("Holy molly wacamolly!!!", "Buddy, your search did not come back with any results","error")
	$("#result_panel").append("<h2>Oppppsss... Sorry no results, please try again?</h2>")
}

$("button").click(function ()
{
	//Extract user input
	userSearchText = $("#search").val()

	//Parse the input of the user
	parseString(userSearchText)

	//If keyword present
	if(displayResultsFlag) 	
	{
		performAJAXrequest()	//Depending on the keywords load the corresponding AJAX

		if(numberOfkeywords > 1)	//If multiple keywords present scan for duplicates
		{
			searchDuplicates() // Search for duplicates
		}

		displayResults()	//Display the results
	}
	else 	//No results
	{
		displayNoResults()	//Insult the user
	}


	//reset variables for next search request
	load_catJSON = false
	load_dogJSON = false
	load_fireJSON = false
	displayResultsFlag = false
	numberOfkeywords = 0;
	listOfResults = []
	return false
})