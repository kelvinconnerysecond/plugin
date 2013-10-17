function showPopTab(tableNum){
  //select the condition
	switch(tableNum)
	{
	  //if select viewed for 30 days
		case 2:
			document.getElementById("tab-two").style.visibility = "visible";	//set visibility
			document.getElementById("tab-two").style.display = "block";	 
			document.getElementById("tab-one").style.display = "none";	
			document.getElementById("tab-three").style.display = "none";	
			break;
		//if select viewed for 1 year	
		case 3:
			document.getElementById("tab-three").style.visibility = "visible";	
			document.getElementById("tab-three").style.display = "block";	
			document.getElementById("tab-one").style.display = "none";	
			document.getElementById("tab-two").style.display = "none";
			break;
		//if select viewed for 7 days	
		default:
			document.getElementById("tab-one").style.visibility = "visible";	
			document.getElementById("tab-one").style.display = "block";	
			document.getElementById("tab-two").style.display = "none";	
			document.getElementById("tab-three").style.display = "none";
			break;
	}
}
