<?
///// CREATE SEARCH QUERY
	
	if($search_operator == 'AND')
	{
		$strSQLsearch = 'Select * from '.strtolower($class_obj).' where id>=0 ';  // the search query has been initialised
		foreach ($_REQUEST as $key_REQUEST => $value_REQUEST)
		{
			if (substr($key_REQUEST,0,6) == 'input_')
			{
				$local_attrib = substr($key_REQUEST,6);
				if ($value_REQUEST != "")
				{
						$strSQLsearch = $strSQLsearch." ".$search_operator." ".$local_attrib." like '%".$value_REQUEST."%' ";    
						// the search query gets incremented by "and columnX = 'valueX.'.. and columnY = 'valueY'
					
				}							// in mySQL, also integers can be "quoted"... This is a loop to create a very basic search query			
			}
		}
		foreach($join_tables as $jt_key => $jt_value)
		{
			$pos = strpos($jt_value,$here);
			if($pos === false) {
						// string needle NOT found in haystack
			}
			else 
			{		// string needle found in haystack
				$therex = str_replace("_","",$jt_value);
				$therex = str_replace($here,"",$therex);
			}
			if(isset($_REQUEST['jt_name_'.$therex]))
			{
				$relation_name = $_REQUEST['jt_name_'.$therex];
				$relation_class = $_REQUEST['jt_class_'.$therex];
			}
	
			if($relation_class != '')
			{
				$sqlSQLmod_rel = 0;
			
				$innerSelect = "Select ".$class_value."_id from ".$relation_name." where true ";
				$innerSelect1 = "Select ".$class_value."_id from ".$relation_name." where true ";      //da sistemare...
				foreach ($_REQUEST as $key_REQUEST => $value_REQUEST)
				{
					if ($sqlSQLmod_rel == 0)
					{
						if (substr($key_REQUEST,0,9) == 'jt_input_' && strpos($key_REQUEST,$therex)!== false)
						{
							$that_id = $value_REQUEST;
							$innerSelect = $innerSelect." and ".$relation_class."_id = ".$that_id;
							$sqlSQLmod_rel = 1;
						}
					}
					if($sqlSQLmod_rel >= 1)
					{
						if (substr($key_REQUEST,0,9) == 'jt_input_' && strpos($key_REQUEST,$therex)!== false) 
						{
							$that_id = $value_REQUEST;
							$innerSelect = $innerSelect." and ".$class_value."_id in (".$innerSelect1." and ".$relation_class."_id = ".$that_id.") ";
							$sqlSQLmod_rel ++;
						}
					}
				}
			}
			
			if ($sqlSQLmod_rel == 0)	// there was no JT search criterio selected, hence all records should be displayed
			{
				$strSQLsearch = $strSQLsearch;
			}
			else
			{
				$strSQLsearch = $strSQLsearch." ".$search_operator." id in (".$innerSelect.")";
			}
		}
		
		//echo "<p>".$strSQLsearch;
	
	}
	
///////  ends the AND section and starts the OR section

	else if($search_operator == 'OR')
	{
		$strSQLor = 'Select * from '.strtolower($class_obj).' where id<0 ';
		$strSQLor_mod = 0;
	
		foreach ($_REQUEST as $key_REQUEST => $value_REQUEST)
		{
			if (substr($key_REQUEST,0,6) == 'input_')
			{
				$local_attrib = substr($key_REQUEST,6);
				if ($value_REQUEST != "")
				{
						$strSQLor = $strSQLor." ".$search_operator." ".$local_attrib." like '%".$value_REQUEST."%' "; 
						$strSQLor_mod = 1;
	
				}							// in mySQL, also integers can be "quoted"... This is a loop to create a very basic search query			
			}
		}
		
		foreach($join_tables as $jt_key => $jt_value)
		{
   
			$pos = strpos($jt_value,$here);
			if($pos === false) {
						// string needle NOT found in haystack
			}
			else 
			{		// string needle found in haystack
				$therex = str_replace("_","",$jt_value);
				$therex = str_replace($here,"",$therex);
			}
   
			if(isset($_REQUEST['jt_name_'.$therex]))
			{
				$relation_name = $_REQUEST['jt_name_'.$therex];
				$relation_class = $_REQUEST['jt_class_'.$therex];
			}
   	
			if($relation_class != '')
			{
				$sqlSQLmod_rel = 0;
		
				if ($search_operator == 'OR')
				{
					$innerSelect = "Select ".$class_value."_id from ".$relation_name." where false ";
					$innerSelect1 = "Select ".$class_value."_id from ".$relation_name." where false ";  
					foreach ($_REQUEST as $key_REQUEST => $value_REQUEST)
					{
					
					//if ($sqlSQLmod_rel == 0)
						{
							if (substr($key_REQUEST,0,9) == 'jt_input_' && strpos($key_REQUEST,$therex)!== false)
							{
								$that_id = $value_REQUEST;
								$innerSelect = $innerSelect." or ".$relation_class."_id = ".$that_id;
								$sqlSQLmod_rel = 1;
								$strSQLor_mod = 1;
							}
						}
					}
				}
				
				if ($sqlSQLmod_rel == 0)	// there was no JT search criterio selected, hence all records should be displayed
				{
					$strSQLor = $strSQLor;
				}
				else
				{
					$strSQLor = $strSQLor." ".$search_operator." id in (".$innerSelect.")";
				}
			}
		}
		
		if($strSQLor_mod == 0)	// there was no search criterio selected, hence all records should be displayed
		{
			$strSQLsearch = 'Select * from '.strtolower($class_obj).' where id>=0 ';  // the search query has been initialised
		}
		else
		{
			$strSQLsearch = $strSQLor;
		}
		
		//echo "<p>".$strSQLsearch;
	
	}
	
	
/*	
	if ($search_operator == 'OR')
	{
		if ($strSQLor_mod == 1)
		{
			$strSQLsearch = $strSQLor;
		}
		else
		{
			$strSQLsearch = $strSQLsearch;
		}
	}
	
	
	
	$benchmark_or_jt = 0;
	$sqlORIJ = "";
	
	//here the search criteria include any further filter based on the related join_table(s) 
	//$relation_class = '';
	//$relation_name = $_REQUEST['jt_name'];
	//$relation_class = $_REQUEST['jt_class'];
	
   foreach($join_tables as $jt_key => $jt_value)
	{
   
		$pos = strpos($jt_value,$here);
		if($pos === false) {
						// string needle NOT found in haystack
		}
		else 
		{		// string needle found in haystack
			$therex = str_replace("_","",$jt_value);
			$therex = str_replace($here,"",$therex);
		}
   
			if(isset($_REQUEST['jt_name_'.$therex]))
			{
			$relation_name = $_REQUEST['jt_name_'.$therex];
			$relation_class = $_REQUEST['jt_class_'.$therex];
			}
   	
	
	
		if($relation_class != '')
		{
			$sqlSQLmod_rel = 0;
		
			if ($search_operator == 'OR')
			{
				$innerSelect = "Select ".$class_value."_id from ".$relation_name." where false ";
				$innerSelect1 = "Select ".$class_value."_id from ".$relation_name." where false ";  
				foreach ($_REQUEST as $key_REQUEST => $value_REQUEST)
				{
					
					//if ($sqlSQLmod_rel == 0)
					{
						if (substr($key_REQUEST,0,9) == 'jt_input_' && strpos($key_REQUEST,$therex)!== false)
						{
							$that_id = $value_REQUEST;
							
							$sqlORIJ = $sqlORIJ ." OR ".$class_value."_id in (".$innerSelect1." or ".$relation_class."_id = ".$that_id.") ";
							
							$benchmark_or_jt = 1;
							
							//$innerSelect = $innerSelect." or ".$relation_class."_id = ".$that_id;
							$sqlSQLmod_rel = 1;
						}
					}
					
					/*
					//if($sqlSQLmod_rel >= 1)
					{
						if (substr($key_REQUEST,0,9) == 'jt_input_' && strpos($key_REQUEST,$therex)!== false) 
						{
							$that_id = $value_REQUEST;
							$innerSelect = $innerSelect." or ".$class_value."_id in (".$innerSelect1." or ".$relation_class."_id = ".$that_id.") ";
							$sqlSQLmod_rel ++;
						}
					}
					
					*/
/*					
				}
			}
		
			else   //search_operator = 'AND'
			{
				$innerSelect = "Select ".$class_value."_id from ".$relation_name." where true ";
				$innerSelect1 = "Select ".$class_value."_id from ".$relation_name." where true ";      //da sistemare...
				foreach ($_REQUEST as $key_REQUEST => $value_REQUEST)
				{
					if ($sqlSQLmod_rel == 0)
					{
						if (substr($key_REQUEST,0,9) == 'jt_input_' && strpos($key_REQUEST,$therex)!== false)
						{
							$that_id = $value_REQUEST;
							$innerSelect = $innerSelect." and ".$relation_class."_id = ".$that_id;
							$sqlSQLmod_rel = 1;
						}
					}
					if($sqlSQLmod_rel >= 1)
					{
						if (substr($key_REQUEST,0,9) == 'jt_input_' && strpos($key_REQUEST,$therex)!== false) 
						{
							$that_id = $value_REQUEST;
							$innerSelect = $innerSelect." and ".$class_value."_id in (".$innerSelect1." and ".$relation_class."_id = ".$that_id.") ";
							$sqlSQLmod_rel ++;
						}
					}
				}
			}
		
	}
	
			if ($sqlSQLmod_rel == 0)
			{
				$strSQLsearch = $strSQLsearch;
			}
			else
			{
				if ($search_operator == 'OR')
				{
					if ($benchmark_or_jt > 0)
					{
						$strSQLsearch = $strSQLor + $sqlORIJ;
					}
					//$strSQLsearch = $strSQLor;
				}
				$strSQLsearch = $strSQLsearch." ".$search_operator." id in (".$innerSelect.")";
			}
		}
	
	echo "<p>".$strSQLsearch;
	
	//////////
*/
?>