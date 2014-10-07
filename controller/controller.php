<?
	$here = isset($_REQUEST['here']) ? $_REQUEST['here'] : "";
	$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : "";
	
	$here = isset($_REQUEST['here']) ? $_REQUEST['here'] : "";
	$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : "general";
	$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : "";
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "1";
	$view_all = isset($_REQUEST['view_all']) ? $_REQUEST['view_all'] : "no";
	$ex_search_query = isset($_REQUEST['ex_search_query']) ? $_REQUEST['ex_search_query'] : "";
	$viewType = isset($_REQUEST['viewType']) ? $_REQUEST['viewType'] : "ordinary";
	
// determines main menu

	include "./view/menu.php";
	
// determines sub_menu

	include "./view/sub_menu.php";
	
// determines main page depending on $here and $mode

	include "./view/main_page.php";
	
	
?>