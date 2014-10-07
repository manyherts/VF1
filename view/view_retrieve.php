<?
/* 
		foreach (MyActiveRecord::Columns($class_value) as $class_attribute => $class_attr_value)
		{
			echo "<P>1 linea ";
			//if(!(hid_keys($class_value,$class_attribute))){
			if((is_array($hidden_keys[$class_value]) && in_array($class_attribute,$hidden_keys[$class_value]))){
				echo "!!! ".$class_value." <b>".$class_attribute."</b> *** "; 
				foreach ($hidden_keys[$class_value] as $pino => $gino){ echo " ".$pino."=>".$gino;}
			}
		}
		
*/
?>

<table class=table1><form id="retrieve_form" action="" method=post>
		<tr>
<?


	foreach (MyActiveRecord::Columns($class_value) as $class_attribute => $class_attr_value)
	{
		if ((is_array($hidden_keys[$class_value]) && in_array($class_attribute,$hidden_keys[$class_value]))){ 
			//if(!(hid_keys($here,$class_attribute))){
			//if(!(is_array($hidden_keys[$class_value]) && in_array($class_attribute,$hidden_keys[$class_value]))){
			//if((in_array($class_attribute,$hidden_keys[$class_value]))){
			}
		else	if (in_array($class_attribute,$foreign_keys)){
				foreach ($foreign_keys as $fk_key => $fk_value){
					if ($class_attribute == $fk_value){
						echo "<th> <!--class_attribute=".$class_attribute." fk_key=".$fk_key." -->".rm_vf1x(name_child_relationship($class_value,$fk_value));
					}
				}
					//echo "<th>owned by";
			}
		else	{
				echo "<th>".$class_attribute;
				
				//if ($class_attribute == 'login_password'){}
				//else{ echo "<th>".$class_attribute; }
			}
	}
//		}	

/*
		else if (in_array($class_attribute,$foreign_keys)){
					foreach ($foreign_keys as $fk_key => $fk_value){
						if ($class_attribute == $fk_value){
							echo "<th><!--class_attribute=".$class_attribute." fk_key=".$fk_key." -->".rm_vf1x(name_child_relationship($class_value,$fk_value));
						}
					}
					//echo "<th>owned by";
				}
		else {
					echo "<th>".$class_attribute;}
	}
	
*/

	foreach ($join_tables as $jt_key => $jt_value)
	{
		$pos = strpos($jt_value,$here);
		if($pos === false) {
						// string needle NOT found in haystack
		}
		else {		// string needle found in haystack
						
			$there = str_replace("_","",$jt_value);
			$there = str_replace($here,"",$there);
			
			echo "<th>associated ".rm_vf1x($there);
			//echo "<script>document.getElementById('div_right').style.height = '230px';document.getElementById('div_right').style.border = 'none';</script><div id=div3>";
			//echo "<p class=p1>manage the ".$jt_value." relationship by the following criterion: ";
			//include "view_displayjt.php";
			//echo "</div>";
		}
	}
	
/*	
	function find_relatedclass($pino,$gino)
	{
		if(in_array($pino,$gino))
		{
			$prepino = substr($pino, 0, -3);
			$pos = strpos($prepino, "_");
			if (!($pos === false)) 
			{
				$prepino = substr($prepino, $pos+1);
			}
			return $prepino;
		}
	}
*/	
	foreach ($obj_class as $obj_key => $obj_value)
	{
		echo "<tr>";
		foreach (MyActiveRecord::Columns($class_value) as $obj_attribute => $obj_attr_value)
		{
//			if (in_array($obj_attribute,$hidden_keys)){
//				if(!(hid_keys($here,$obj_attribute))){
				
				if (is_array($hidden_keys[$class_value]) && (in_array($obj_attribute,$hidden_keys[$class_value]))){ 
				
				}
				
				else	if ($obj_attribute=="id"){
						echo "<td><a href=javascript:update_obj('".$current_file_name."','".$class_value."',".$obj_value->$obj_attribute.",'".$module."','".$page."','".$view_all."');>".$obj_value->$obj_attribute."</a>";}
				else if (strlen($obj_attribute)> 2 && !(strpos($obj_attribute,"_id")===false)){
						//$related_class = substr($obj_attribute, 0, -3);
						$related_class = find_relatedclass($obj_attribute,$foreign_keys);
						//echo "<td>related_class = ".$related_class;
						echo "<td>".$obj_value->$obj_attribute.". ".$obj_value->find_parent($related_class,$obj_attribute)->referred_as;				
				/*
				if($obj_attribute == "from_location_id")
				{
					echo "CIAO!!!! ".$related_class." - ".$obj_value->find_parent($related_class,$obj_attribute)->referred_as;
				}
				*/
					}
					else
					{
						//echo "<td>".$obj_value->$obj_attribute;
						
						
						{ echo "<td>".$obj_value->$obj_attribute; }
					}
						//echo "<td>".$obj_value->$obj_attribute;}
				}
			//}
			
/*			
			else{ 
				if ($obj_attribute=="id"){
					echo "<td><a href=javascript:update_obj('".$current_file_name."','".$class_value."',".$obj_value->$obj_attribute.",'".$module."','".$page."','".$view_all."');>".$obj_value->$obj_attribute."</a>";}
				else if (strlen($obj_attribute)> 2 && !(strpos($obj_attribute,"_id")===false)){
						//$related_class = substr($obj_attribute, 0, -3);
						$related_class = find_relatedclass($obj_attribute,$foreign_keys);
						//echo "<td>related_class = ".$related_class;
						echo "<td>".$obj_value->$obj_attribute.". ".$obj_value->find_parent($related_class,$obj_attribute)->referred_as;				
				/*
				if($obj_attribute == "from_location_id")
				{
					echo "CIAO!!!! ".$related_class." - ".$obj_value->find_parent($related_class,$obj_attribute)->referred_as;
				}
				
					}
				else{
					echo "<td>".$obj_value->$obj_attribute;}
			}
			
		}
		//////
	}
	
*/

	foreach ($join_tables as $jt_key => $jt_value)
	{
		$pos = strpos($jt_value,$here);
		if($pos === false) {
						// string needle NOT found in haystack
		}
		else {		// string needle found in haystack
						
			$there = str_replace("_","",$jt_value);
			$there = str_replace($here,"",$there);
			
			echo "<td>";
			$i = 0;
			foreach ($obj_value->find_attached($there) as $_fakey => $_favalue)
			{
				if ($i == 0)
				{
				echo " ".$_favalue->referred_as;
				$i++;
				}
				else
				{
				echo ", ".$_favalue->referred_as;
				$i++;
				}
			}
			
			//echo "<script>document.getElementById('div_right').style.height = '230px';document.getElementById('div_right').style.border = 'none';</script><div id=div3>";
			//echo "<p class=p1>manage the ".$jt_value." relationship by the following criterion: ";
			//include "view_displayjt.php";
			//echo "</div>";
		}
	}
}
	
?>

	</table>
<?	
	
	ECHO '<input type=hidden name=ex_search_query id=ex_search_query value="'.$strSQLsearch.'" size=90>'; 
	//ECHO $strSQLsearch;
	
?>	
	</form>