/**
 * Script for matches index
 * @version 0.0.1
 * 
 */

var start = 0;
var limit = 10;
var type = 1;
/**
 * State
 */
var state = "new";
$(document).ready(function(){
	interval = setInterval("updateStatus()", 1000, "javaScript");
	loadNew();
	$("#new_tab_nav").click(function(){
		state = "new";
		loadContent(1);
		type=1;
		$("#tab li.active").removeClass("active");
		$(this).parent().addClass("active");
	});
	$("#communicating_tab_nav").click(function(){
		state = "communicating";
		loadContent(2);
		type=2;
		$("#tab li.active").removeClass("active");
		$(this).parent().addClass("active");
	});
	$("#archive_tab_nav").click(function(){
		state = "archive";
		loadContent(3);
		type=3;
		$("#tab li.active").removeClass("active");
		$(this).parent().addClass("active");
	});
	
	$("#next").click(function(){
		$("#previous").show();
		start+=limit;
		loadContent(type);
	});
	$("#previous").click(function(){
		start-=limit;
		loadContent(type);
		if (start==0){
			$("#previous").hide();
		}
	});
	$("#display").change(function(){
		limit = $(this).val();
		start = 0;
		$("#record_count").text(limit);
		loadContent(type);
	});
	$("#clear_search").click(function(){
		$("#search_match").val("");
	});
	$("#search_form").submit(function(){
		$.ajax({
			url:qalanjo_url+"matches/search/"+type,
			data:$("#search_form").serialize(),
			type:"post",
			success:function(data){
				$("#matches-list").html(data);
			}
		});
		return false;
	});
	$("#search_match").val("");
	limit = $("#display").val();
	$("#previous").hide();
});

function loadContent(type){
	var url = "";
	if (limit==0){
		limit = 10;	
	}
	url = qalanjo_url+"matches/loadMatches/"+type+"/start:"+(start)+"/limit:"+(limit);
	$.ajax({
		url:url,
		success:function(data){
			$("#matches-list").html(data);
			$.ajax({
				url:qalanjo_url+"matches/loadMatchCount/"+type,
				success:function(data){
					$("#max_count").text(data);
					if (limit>=parseInt(data)){
						limit = parseInt(data);
					}
					if (parseInt(data)!=0){
						var temp0 = start+1;
						$("#start_index").text(temp0);
						var temp = parseInt(limit)+start;
						$("#record_count").text(temp);
						$("#next").removeAttr("disabled");
					}else{
						$("#start_index").text("0");
						$("#record_count").text("0");
						$("#next").attr("disabled", "disabled");
					}
				}
			});
		}
	});
}

function loadNew(){
	loadContent(1);
}
