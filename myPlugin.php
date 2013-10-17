<?php   
    /* 
    Plugin Name: Web Statistic 
    Description: Plugin for displaying popular post during certain period
    Author: Kelvin Connery
    Version: 1.0 
    Author URI:  
    */
	//authentication for user and gather the google analytic info
	function pop_admin(){
		getPopularPost('hwhwhwhwhw123@gmail.com','123admin123','77879940'); //pass the parameter to getPopularPost
	}
	//function for get the popular post
	function getPopularPost($ga_email,$ga_pass,$ga_profile_id){
		require 'gapi.class.php'; //include the gapi.class.php
		//create new gapi object
		$ga = new gapi($ga_email,$ga_pass);
		//displaying data according to the filter
		fetchData($ga, $ga_profile_id, '-7 day','tab-one');
		fetchData($ga, $ga_profile_id, '-1 month','tab-two');
		fetchData($ga, $ga_profile_id, '-1 year','tab-three');
		
		
		
	}
	//function for displaying
	function fetchData($ga,$ga_profile_id,$range,$css_id){
				
		
		$endTime = new DateTime('+8 hour');//+8 according to malaysian time zone
		$endTimeStr = date_format($endTime,'Y-m-d');
		
		$startTime = $endTime->modify($range);//set the lower bound
		$startTimeStr = date_format($startTime, 'Y-m-d');
		
		$ga->requestReportData($ga_profile_id,array('pagePath'),array('pageviews', 'uniquePageviews'),array('-pageviews'),'pagePath != /',$startTimeStr,$endTimeStr,1,10);
		
		echo "<div class='wrap' id=$css_id>From: ".$startTimeStr.' until '.$endTimeStr.'<br/>'; 
		//displaying result
		echo '<table>';
		foreach($ga->getResults() as $result)
		{
			
			$resultStr = explode("/",$result);//hide unnecessary data
			$num = (count($resultStr)-2);//get the index of page name
			echo '<tr><td>'.$resultStr[$num].'</td><td>';
			echo $result->getPageviews().'</td></tr>';
		}
		echo '</table>';
	}
	//adding plugin to wp admin		
	function popular_post_actions() {
		add_options_page("Popular Post", "Popular Post","manage_options" ,__FILE__, "pop_admin");
	}
	add_action('admin_menu', 'popular_post_actions');
?>  
