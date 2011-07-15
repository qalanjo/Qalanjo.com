
<?php echo $this->element('itemsForGiftScrollable',array('type'=>$type));?>

<script type="text/javascript">
	$(document).ready(function(){
	
		// split the url of the next button that is clicked and get its length and last index of the splitted url
		
		var url_split = $('#nextForGiftViewing').attr('href').split('/');
		var _array_length = url_split.length;
		var _last_index = _array_length - 1;
		url_split[_last_index] = "<?php echo $type['Gift'][sizeof($type['Gift'])-1]['id'];?>";
		
		// the new url for the next button that is clicked
		var new_url = get_new_url_to_view(url_split, _array_length);
		
        assign_new_url_to_view(new_url);
        
	});
	
	function get_new_url_to_view(url_split, _array_length){
	
		var i = 1;
		var new_url = '';
		for(i = 1;i < _array_length;i++){
		
			// concatenate the url with '/' in the beginning
			new_url += '/'+url_split[i];
		}
		return new_url;
	}
	
	function assign_new_url_to_view(new_url){
		
		// finally assign the new_url to the next button's href
		var events = $('#nextForGiftViewing').data("events");
        $('#nextForGiftViewing').unbind('click', events.click[0]);
		
        var EOF = "<?php echo $type['EOF'];?>";
        if(EOF != "1"){
        	$('#nextForGiftViewing').bind('click', function(){ $.ajax({async:true, type:'post', complete:function(request, json) {$('#newItemForViewing').html(request.responseText); viewAddItem()}, url:new_url}) });
        }
	}
	
</script>