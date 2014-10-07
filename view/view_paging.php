<?

//////////////////////////////////// QUERY LIMIT - PAGING MANAGEMENT //////////////////////////
	//echo " PAGE NUMBER = ".$page_number;

echo "<p class=p1>found records: ".$count_obj_class." ";
		
		if ($count_obj_class > $limit_records_per_page)
		{
			if ($view_all == "no")
			{
				echo "¦";
				if ($page_number > floor($count_obj_class / $limit_records_per_page))
				{
					if ($mode == 'general' || $mode == '')
					{
						echo " <a href='". $current_file_name."?here=".$class_value."&class_obj=".$class_value."&module=".$module."&page=".($page - 1)."&mode=".$mode."'>previous</a> ¦";
					}
					else if ($mode == 'confirm_search')  
					{
						echo " <a href=javascript:manage_search_paging('".$current_file_name."','".$here."','".$class_obj."','".$module."','no','".($page - 1)."'); >previous</a> ¦";
					}
				
				}
				
				if ($page_number+$limit_records_per_page <= $count_obj_class)
				{
					echo " listed records (".($page_number+1).",".($page_number+$limit_records_per_page).")";
				}
				else
				{
					echo " listed records (".($page_number+1).",".($count_obj_class).")";
				}
				//$count_obj_local_class =MyActiveRecord::COUNT($class_value,'id > -1 '.$limit_query);
				//echo "PROVA!!! ".$count_obj_local_class;
				//echo " listed records (".($page_number+1).",".($page_number+$count_obj_local_class).")";
				if (($page) < (($count_obj_class / $limit_records_per_page)))
				{
					if ($mode == 'general' || $mode == '')
					{
						echo " ¦ <a href='". $current_file_name."?here=".$class_value."&class_obj=".$class_value."&module=".$module."&page=".($page + 1)."&mode=".$mode."'>next</a>";
					}
					else if ($mode == 'confirm_search')  
					{
						echo " ¦ <a href=javascript:manage_search_paging('".$current_file_name."','".$here."','".$class_obj."','".$module."','no','".($page + 1)."'); >next</a>";
						
						/* 
						echo " ¦ <a href=javascript:document.getElementById('search_form').action='".$current_file_name."?here=".$here."&mode=confirm_search&class_obj=".$class_obj."&module=".$module."&page=".($page + 1)."';document.getElementById('search_form').submit();>next</a>";
						*/
					}
				}
				
				if ($mode == 'general' || $mode == '')
				{
					echo " ¦ <a href='". $current_file_name."?here=".$class_value."&class_obj=".$class_value."&module=".$module."&view_all=yes&mode=".$mode."'>list all</a>";
				}
				else if ($mode == 'confirm_search')  
				{
					//// modificare no con yes???
					echo " ¦ <a href=javascript:manage_search_paging('".$current_file_name."','".$here."','".$class_obj."','".$module."','yes','".($page + 1)."'); >list all</a>";
				}
				else if ($mode == 'update' || $mode == 'confirm_update')
				{
					echo " ¦ <a href='". $current_file_name."?here=".$class_value."&class_obj=".$class_value."&view_all=yes&mode=".$mode."&class_obj_id=".$class_obj_id."'>list all</a>";
				}
				else
					echo " ¦ <a href='". $current_file_name."?here=".$class_value."&class_obj=".$class_value."&module=".$module."&view_all=yes&mode=".$mode."'>list all</a>";
			
			}
			
			
			else // ($view_all == "yes")
			{
				if ($mode == 'general' || $mode == '')
				{
					echo " ¦ <a href='". $current_file_name."?here=".$class_value."&class_obj=".$class_value."&module=".$module."&page=1&mode=".$mode."'> first ".$limit_records_per_page." records only </a> ";
				}
				else if ($mode == 'confirm_search')  
				{
				echo " ¦ <a href=javascript:manage_search_paging('".$current_file_name."','".$here."','".$class_obj."','".$module."','no','1'); > first ".$limit_records_per_page." records only </a>";
				}
			}
		
		}




?>