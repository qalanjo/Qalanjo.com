/**
 * 
 */
function handleSelect(event, tab){
	var header = "";
	var message = "";
	if (tab.index==0){
		header = "Quick Search";
		message = "Our quick search utility allows you to search singles fast, without getting to specific. If you want to get really detailed, click on the <strong>Advanced Search</strong> Link";
	}else if (tab.index==1){
		header = "Advance Search";
		message = "Our advance search utility allows you to customize your date searching by providing us more details of what you are finding";
	}else if (tab.index==2){
		header = "Photo Gallery Search";
		message = "Our photo gallery search utility allows you see some of the singles faces to have a close look";
	}else if (tab.index==3){
		header = "Nickname Search";
		message = "You might want to find someone by recalling his or her nickname. This utility can provide searching by nickname";
	}else if (tab.index==4){
		header = "Keyword Search";
		message = "Our keyword search provides you ways to find dates by extracting information from the thoughts of others.";
	}
	$("#title").html(header).fadeIn();
	$("#search_message").html(message).fadeIn();
}

var tabOpts = {
	select:handleSelect	
};
$("#search_tab").tabs(tabOpts);

$("input:submit").button();