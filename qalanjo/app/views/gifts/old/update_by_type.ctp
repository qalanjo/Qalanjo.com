
<?php echo $this->element('itemsForGiftScrollable',array('type'=>$type,'search_more'=>1));?>

<script type="text/javascript">
	$(document).ready(function(){
	
		// split the url of the next button that is clicked and get its length and last index of the splitted url
		
		var url_split = $('#nextFor<?php echo $type['GiftType']['id'];?>').attr('href').split('/');
		var _array_length = url_split.length;
		var _last_index = _array_length - 1;
		url_split[_last_index] = "<?php echo $type['Gift'][sizeof($type['Gift'])-1]['id'];?>";
		
		// the new url for the next button that is clicked
		var new_url = get_new_url(url_split, _array_length);
		
        assign_new_url(new_url);
        
	});
	
	function get_new_url(url_split, _array_length){
	
		var i = 1;
		var new_url = '';
		for(i = 1;i < _array_length;i++){
		
			// concatenate the url with '/' in the beginning
			new_url += '/'+url_split[i];
		}
		return new_url;
	}
	
	function assign_new_url(new_url){
		
		// finally assign the new_url to the next button's href
		var events = $('#nextFor<?php echo $type['GiftType']['id'];?>').data("events");
        $('#nextFor<?php echo $type['GiftType']['id'];?>').unbind('click', events.click[0]);
		
        var EOF = "<?php echo $type['EOF'];?>";
        if(EOF != "1"){
        	$('#nextFor<?php echo $type['GiftType']['id'];?>').bind('click', function(){ $.ajax({async:true, type:'post', complete:function(request, json) {$('#newItemFor<?php echo $type['GiftType']['id'];?>').html(request.responseText); addItem(<?php echo $type['GiftType']['id'];?>)}, url:new_url}) });
        }
	}
	
</script>