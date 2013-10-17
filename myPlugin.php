<?php   
    /* 
    Plugin Name: Web Statistic 
    Description: Plugin for displaying popular post during certain period
    Author: 
    Version: 1.0 
    Author URI:  
    */
	
	function pop_admin(){
		getPopularPost('hwhwhwhwhw123@gmail.com','123admin123','77879940');
	}
	
	function getPopularPost($ga_email,$ga_pass,$ga_profile_id){
		require 'gapi.class.php';
		
		$ga = new gapi($ga_email,$ga_pass);
		
		fetchData($ga, $ga_profile_id, '-7 day','tab-one');
		fetchData($ga, $ga_profile_id, '-1 month','tab-two');
		fetchData($ga, $ga_profile_id, '-1 year','tab-three');
		
		
		
	}
	
	function fetchData($ga,$ga_profile_id,$range,$css_id){
				

		$endTime = new DateTime('+8 hour');
		$endTimeStr = date_format($endTime,'Y-m-d');
		
		$startTime = $endTime->modify($range);
		$startTimeStr = date_format($startTime, 'Y-m-d');
		
		$ga->requestReportData($ga_profile_id,array('pagePath'),array('pageviews', 'uniquePageviews'),array('-pageviews'),'pagePath != /',$startTimeStr,$endTimeStr,1,10);
		
		echo "<div class='wrap' id=$css_id>From: ".$startTimeStr.' until '.$endTimeStr.'<br/>'; 
		
		echo '<table>';
		foreach($ga->getResults() as $result)
		{
			
			$resultStr = explode("/",$result);
			$num = (count($resultStr)-2);
			echo '<tr><td>'.$resultStr[$num].'</td><td>';
			echo $result->getPageviews().'</td></tr>';
		}
		echo '</table>';
	}
			
	function popular_post_actions() {
		add_options_page("Popular Post", "Popular Post","manage_options" ,__FILE__, "pop_admin");
	}
	add_action('admin_menu', 'popular_post_actions');
?>  
