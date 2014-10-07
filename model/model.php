<?
	
	// The application title is defined here 
	$application_title = "VF1 v.1.6.2 - Case Study: Airplane Ticket Booking Management System";
	
	// The application database and the connection string are defined here
	// syntax is: 'username@database.server/database_name IDENTIFIED BY PASSWORD ' 
	define('MYACTIVERECORD_CONNECTION_STR', 'mysql://root@localhost/airplaneticket');
	
	// includes used implementation of MyActiveRecord class 
	include './include/MyActiveRecord.0.4.php';
	
	//in this array we list all and only those classes we like to CRUD manage from the main menu 
	$classes = array('airline','location','flight','ticket','customer','facility','itinerary');  
	
	$modules = array();
	
	// in this array we list all join tables which hold many to many relationships between two given classes of objects
	$join_tables = array('facility_location','itinerary_location');	
	
	// in this array below we list all foreign keys: this array MUST EXIST: if empty then uncomment line below (and comment the following one!)
	//foreign_keys=array();
	$foreign_keys = array('airline_id','from_location_id','to_location_id','flight_id','customer_id','status_id','document_id','title_id','itinerary_id','location_id'); 
	
	$classes_order_pattern = array();   	// this includes all classes from $classes that need to be CRUD-managed similarly to an order 
															//(one order-many order lines), including potentially many order lines
	$classes_order_pattern_related = array();
	
	$classes_diary_pattern = array(); //this includes all classes from $classes that need to be displayed as a diary
	$classes_diary_pattern_related = array();
	
	$limit_records_per_page = 10;
	
	$order_by_default = "id DESC";
	
	// relationships between entities/classes are named below: if no name has
	// been given to a certain relationship, the bare foreign key would be displayed
	function name_child_relationship($class_name,$foreign_key)
	{
		if ($class_name == 'customer' && $foreign_key == 'title_id')
		{
			return " title ";
		}
		else if ($class_name == 'customer' && $foreign_key == 'document_id')
		{
			return " document ";
		}
		else if ($class_name == 'flight' && $foreign_key == 'from_location_id')
		{
			return " from ";
		}
		else if ($class_name == 'flight' && $foreign_key == 'to_location_id')
		{
			return " to ";
		}
		else if ($class_name == 'flight' && $foreign_key == 'airline_id')
		{
			return " airline ";
		}
		else if ($class_name == 'ticket' && $foreign_key == 'flight_id')
		{
			return " flight ";
		}
		else if ($class_name == 'ticket' && $foreign_key == 'customer_id')
		{
			return " customer ";
		}
		else if ($class_name == 'ticket' && $foreign_key == 'status_id')
		{
			return " status ";
		}
		else if ($class_name == 'itinerary' && $foreign_key == 'customer_id')
		{
			return " worst customer! ";
		}
		else
			return $foreign_key;
	}
	
	function rm_vf1x($pippo)
	{
		if (substr($pippo,0,4)=='vf1x'){
			return(substr($pippo,4));}
		else{
			return($pippo);}
	}
	
	// this array has been initiated, but its usage will be defined in future versions of VF1
	$objects = array();
	
	// classes are defined below as extensions of MyActiveRecord class
	class airline extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class location extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class flight extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class ticket extends MyActiveRecord{
			function destroy(){
			}	
		}
	
	class status extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class document extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class customer extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class title extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class facility extends MyActiveRecord{
			function destroy(){
			}	
		}
		
	class itinerary extends MyActiveRecord{
			function destroy(){
			}	
		}
	

?>