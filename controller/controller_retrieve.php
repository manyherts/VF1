<?
	
	$page_number = ($page -1) * $limit_records_per_page;
	$limit_query = "LIMIT ".($page_number).",".$limit_records_per_page;
	
	if($order_by[$class_value] != '')
	{
		//print_r $order_by[$class_value];
	}
	else
	{
		//$order_by[$class_value] = array();
		$order_by[$class_value] = $order_by_default;
	}
	
	
	if($mode == 'confirm_search')    //  if $mode is equal to "confirm_search"!!!
	{
		include "sub_controller_search.php";   /////// CREATES SEARCH QUERY and defines $strSQLsearch and ...
		$obj_class = MyActiveRecord::FindBySql($class_value, $strSQLsearch);
		$count_obj_class =count($obj_class);
		if ($view_all == 'no')
		{
			$obj_class = MyActiveRecord::FindBySql($class_value, $strSQLsearch." ".$limit_query);
		}
		
		//include "./view/view_paging.php";
		//include "./view/view_retrieve.php";
		
		// room to create a new retrieve visualization format (e.g., a diary) and then check whether the class expects to use the ordinary retriever (i.e., view_retrieve.php) or a new retriever
		//(e.g., view_retrieve_diary.php)
		
		/*
		if(in_array($class_value,$classes_diary_pattern))
		{
			//echo "CIAO!!!!! (in controller_retrieve.php)";
			include "./view/view_display_diary_main.php";
		}
		else
		*/
		{
			include "./view/view_paging.php";
			include "./view/view_retrieve.php";
		}
		
		
	}   //end else ($mode is equal to "confirm_search)" !!!
	
	else 	if ($mode != 'confirm_search') 
	{
		if ($ex_search_query == "")
		{
			$count_obj_class =MyActiveRecord::COUNT($class_value,'id > -1');
			if ($view_all == 'no')
			{
				$obj_class = MyActiveRecord::FindBySql($class_value, 'SELECT * FROM '.$class_value.' WHERE id > -1 ORDER BY '.$order_by[$class_value].' '.$limit_query);
			}
			else
			{
				$obj_class = MyActiveRecord::FindBySql($class_value, 'SELECT * FROM '.$class_value.' WHERE id > -1 ORDER BY '.$order_by[$class_value].' ');
			}
		}
		else
		{
			//echo "PPPPPP1: ".$ex_search_query;
			$obj_class = MyActiveRecord::FindBySql($class_value,$ex_search_query);
			$strSQLsearch = $ex_search_query;
			$count_obj_class =count($obj_class);
		}
		
		//include "./view/view_paging.php";
		//include "./view/view_retrieve.php";		
		
		// room to create a new retrieve visualization format (e.g., a diary) and then check whether the class expects to use the ordinary retriever (i.e., view_retrieve.php) or a new retriever
		//(e.g., view_retrieve_diary.php)
		
		
		if(in_array($class_value,$classes_diary_pattern))
		{
			//echo "CIAO!!!!! (in controller_retrieve.php)";
			include "./view/view_display_diary_main.php";
			//$mode = 'confirm_search';
		}
		else
		{
			include "./view/view_paging.php";
			include "./view/view_retrieve.php";
		}
		
		
		//echo "ORDER BY (class: ".$class_value."): ".$order_by[$class_value];
		//ECHO '<p>SQL query used: <input type=text name=ex_search_query value="'.$strSQLsearch.'" size=90>'; 
	} // end $mode != "confirm_search"
	
?>