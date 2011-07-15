/**
 * Inbox script
 * @version 0.0.1
 */
var default_text = "";
var tabs;
var current_message = -1;
var tabsContent = new Array();
var tabCount = 0;
var loadCountSucceed = true;
function autocomplete_searchmail(){
	$("#search_mail").autocomplete({
		source:qalanjo_url+"private_messages/autocomplete/",
		minlength:2,
		select:function(event, ui){
			var items = ui.item.value.split(";");
			ui.item.value = items[0];			
		},
		open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function(event, ui) {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					
		},
		blur:function(){
			$( this ).removeClass( "ui-corner-top" ).removeClass( "ui-corner-all" );
		
		}
	});
}

function autocomplete_member(){
	$("#member_search").autocomplete({
		source:qalanjo_url+"members/autocomplete_member",
		minlength:2,
		select:function(event, ui){
			var items = ui.item.value.split(";");
			ui.item.value = items[0];
			$("#PrivateMessageToId").val(items[1]);			
		},
		open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function(event, ui) {
			$( this ).removeClass( "ui-corner-top" );
					
		}
	}).data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a>"+ item.label + "</a>" )
            .appendTo( ul );
    };;
}
function initializeBox(){
	//autocomplete_searchmail();
	autocomplete_member();
	$("#writeMessageDialog").hide();
	$("#writeMessageDialog input:submit").button();
}

function close_window(){
	$("#writeMessageDialog").dialog('close');
	$("#result").dialog({
		modal:true, height:200, width:250,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		},
		show:"fade",
		hide:"fade"
	});
}

function setInbox(){
	if (loadCountSucceed){
		loadCountSucceed = false;
		$.ajax({
			url:qalanjo_url+"receive_messages/countType",
			success:function(data){
				var result = $.parseJSON(data);
				$("#inbox-items").text("("+result.inbox+")");
				$("#sent-items").text("("+result.sent+")");
				$("#trash-items").text("("+result.trash+")");
				loadCountSucceed = true;
			}
		});	
	}
}


function addTab(title, url) {
	if (tabCount!=6){
		if (tabCount==0){
			tabsContent[tabCount] = title;
 			tabs.tabs( "add", url, title );
			tabCount++;
			tabs.tabs("select", tabCount);
		}else{
			var found = false;
			for(var i=0;i<tabCount;i++){
				if (tabsContent[i]==title){
					found = true;
					tabs.tabs("select", i+1);
					break;
				}
			}
			if (!found){
				tabsContent[tabCount] = title;
	 			tabs.tabs( "add", url, title );
				tabCount++;
				tabs.tabs("select", tabCount);
			}
		}
	}
}

$(document).ready(function(){
	//interval = setInterval("updateStatus()", 2000, "javaScript");
	$("#writeMessageDialog").hide();
	initializeBox();
	$("#new_message").click(function(e){
		$("#writeMessageDialog").dialog(
			{modal:true, height:400, width:450, title:"Write your message", show:"fade", hide:"fade"}
		);
		e.preventDefault();
	});
	tabs = $("#messages-tab").tabs();
	if (state=="inbox"){
		$("#back-button, #delete-message-button, #spam-button").hide();
	}else{
		$("#delete-selected-button").hide();
		default_text = "Write a message...";
	}
	setInterval("setInbox()", 500, "javaScript");
	$("#deletebox").hide();
	$("#back-button").attr("href", qalanjo_url+"receive_messages/inbox/"+member_id+"/all/ajax");
	$("#back-button").click(function(e){
		var href = $(this).attr("href");
		$.ajax({
			url:href,
			success:function(data){
				$("#messages").html(data).hide().fadeIn();
				$("#back-button, #delete-message-button, #spam-button").fadeOut();
				$("#delete-selected-button").fadeIn();	
				$("#header").text("My QMail");	
			}
			
		});
		e.preventDefault();
	});
	$("#delete-message-button").click(function(e){
		e.preventDefault();
	});
	$(".match-list-item").live("click", function(e){
		$("#search-result-list").children(".match-item-selected").removeClass("match-item-selected");	
		$(this).addClass("match-item-selected");
	});
	
	$("#select-match").live("click", function(e){
		var id = $("#search-result-list").children(".match-item-selected").attr("id");
		var ids = id.split("_");
		$("#PrivateMessageToId").val(ids[1]);
		var nameSelected = $("#search-result-list").children(".match-item-selected").children(".name-message").children(".name").text();
		$("#member_search").val(nameSelected);
		$("#match-selector").dialog("close");
		e.preventDefault();
	});
	
	$("#close-match").live("click", function(e){
		$("#match-selector").dialog("close");
		e.preventDefault();
	});
	
	/*
	$("#new_message").live("click", function(e){
		$("#writeMessageDialog").dialog(
			{modal:true, height:400, width:450, title:"Write your message", show:"fade", hide:"fade"}
		);
		e.preventDefault();
	});
	*/
	$(".match-selector").live("click", function(e){
		$("#match-selector").dialog(
			{height:450, width:450, title:"Select a recipient for your match", show:"fade", hide:"fade"}
		);
		$("#search-result-list").load(qalanjo_url+"matches/load_matches");
		e.preventDefault();
	});
	$("#match-selector").hide();
	$("#move_trash").live("click", function(e){
		$("#action").val(3);
		$.post(qalanjo_url+"receive_messages/delete_selected", $("#selector").serialize(), function(data){
			$("#content_inbox").html(data);
		});
		e.preventDefault();
	});
	$("#checkbox1").live("click", function(e){
		$(".control_check").attr("checked", $(this).attr("checked"));
	});
	$(".control_check").live("click", function(e){
		e.stopPropagation();
	})
	$("#unread").click(function(e){
		$("#content_inbox").load(qalanjo_url+"receive_messages/inbox/"+member_id+"/unread/ajax/ajax");
		e.preventDefault();
	});
	$("#read").click(function(e){
		$("#content_inbox").load(qalanjo_url+"receive_messages/inbox/"+member_id+"/read/ajax/ajax");
		e.preventDefault();
	});
	$("#trash").click(function(){
		$("#content_inbox").load(qalanjo_url+"receive_messages/inbox/"+member_id+"/trash/ajax/ajax");
		e.preventDefault();
	});
	$("div.message").live("click", function(e){
		var id = $(this).attr("id");
		var temp = id.split("_");
		var title = $(this).children("ul").children("li.message").children("span").html();
		addTab(title, qalanjo_url+"private_messages/read/"+temp[1]);
		e.preventDefault();
		e.stopPropagation();
	});
	$("#delete-selected-button").click(function(e){
		$("#deletebox").dialog(
					{modal:true,
					height:140,
					show:"fade",
					hide:"fade",
					buttons: {
						Delete: function() {
							$.post(qalanjo_url+"receive_messages/mark_selected/4", $("#selector").serialize(), function(data){
								$("#messages").load(qalanjo_url+"receive_messages/load_inbox/1");
								$("#deletebox").dialog("close");
							});
							e.preventDefault();
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					}
				});
	});
	$("#checkmail").click(function(e){
		$(".left-bar-controls li.active").removeClass("active");
		var url = $("#inbox-link").addClass("active").children("a").attr("href");
		$("#messages").load(url);
		e.preventDefault();
	});
	$(".left-bar-controls li a").click("click", function(e){
		$(this).parent().parent().children("li.active").removeClass("active");
		$(this).parent().addClass("active");
		
		$("#messages").load($(this).attr("href"), function(data){
			
		});
		e.preventDefault();
	});
	
	
});

