function display_div_right()
{
	/* alert('ciao'); this function displays the form to create, update or search existing records on the right of the main listings */
	
	document.getElementById('div2').style.width = '55%';
	document.getElementById('div_right').style.width = '45%';
}

function update_obj(file_name,class_name,obj_id,module_name,page,view_all)
{
	/* alert("CIAO");  */
	if (document.getElementById('ex_search_query').value == "")
	{
		document.location = file_name+"?"+"&here="+class_name+"&class_obj="+class_name+"&class_obj_id="+obj_id+"&mode=update&module="+module_name+"&page="+page+"&view_all="+view_all+"";
	}
	else
	{
		document.getElementById('retrieve_form').action = file_name+"?"+"&here="+class_name+"&class_obj="+class_name+"&class_obj_id="+obj_id+"&mode=update&module="+module_name+"&page="+page+"&view_all="+view_all+"";
		document.getElementById('retrieve_form').submit();
	}

}



function confirm_update_ex_search_obj(file_name,class_name,obj_id,module_name,page,view_all)
{
	/* alert("CIAO");  */
	//called in main_page.php
	document.getElementById('retrieve_form').action = file_name+"?"+"&here="+class_name+"&class_obj="+class_name+"&class_obj_id="+obj_id+"&mode=update&module="+module_name+"&page="+page+"&view_all="+view_all+"&post_update="+obj_id+"";
		document.getElementById('retrieve_form').submit();
}

function change_obj(obj_name)
{
	/* alert(obj_name); */ 
	var selobj = document.getElementById('select_'+obj_name);
	document.getElementById('input_'+obj_name).value = selobj.options[selobj.selectedIndex].value;
}

function change_obj_plus_referred(obj_name)
{
	/* alert(obj_name); */ 
	var selobj = document.getElementById('select_'+obj_name);
	document.getElementById('input_'+obj_name).value = selobj.options[selobj.selectedIndex].text;
}

function confirm_create(form_id)
{
	if(confirm('Would you like to create this new record?'))
	{
		document.getElementById(form_id).submit();
	}
}

function confirm_update(form_id)
{
	if(confirm('Would you like to update this record?'))
	{
		
		document.getElementById(form_id).submit();
	}
}

function manage_search_paging(file_name, here,class_obj,module,view_all,page)
{
	document.getElementById('search_form').action=""+file_name+"?here="+here+"&mode=confirm_search&class_obj="+class_obj+"&module="+module+"&view_all="+view_all+"&page="+page;
	document.getElementById('search_form').submit();
}



function close_div(pippo)
{
	document.getElementById(pippo).style.visibility = "hidden";
}



 
function check_populate_referred_as(classe) {
	var pippo;
	var checkclasse;
	pippo = "";
	checkclasse = 0;
	if(classe == "vf1xcustomer") {
		pippo = document.getElementById('input_name').value + " " + document.getElementById('input_surname').value;
		checkclasse = 1;}
	if(classe == "vf1xcruisediary") {
		pippo = document.getElementById('select_vf1xcruise_id').options[document.getElementById('select_vf1xcruise_id').selectedIndex].text + " " + document.getElementById('input_starting_date').value;
		checkclasse = 1;}
	if(checkclasse == 1){
		if(document.getElementById('input_referred_as').value == "") {
			document.getElementById('input_referred_as').value = pippo; }
		else if (document.getElementById('input_referred_as').value != pippo) {
			if(confirm('Would you like to automatically allocate the "referred_as" value for this record?')){
				document.getElementById('input_referred_as').value = pippo; }}}
}




function resizeIframe()
{
	document.getElementById('div_frame').style.height = eval(window.innerHeight - 217);
}



function chooseView(viewType,file_name,class_name,mode,module_name,page,view_all)
{
	document.location = file_name+"?"+"&here="+class_name+"&class_obj="+class_name+"&mode=general&module="+module_name+"&page="+page+"&view_all="+view_all+"&viewType="+viewType+"";
}