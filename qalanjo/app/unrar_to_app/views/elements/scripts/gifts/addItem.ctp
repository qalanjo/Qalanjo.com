
<!--script to addItems in the next button of the typeId-->

<script type="text/javascript">
		function addItem(typeId) {
			
			if(window['clicksFor'+typeId] <4){
				// get handle to scrollable API
				var api = $(".scrollable"+typeId).data("scrollable");
				
				// use API to add our new item. after the item is being added seek to the end
				var temp = '#newItemFor'+typeId+' div';
				api.addItem($(temp).clone()).next();
				window['clicksFor'+typeId] +=1;
			}else{
				$(".scrollable"+typeId).next();
			}
		}
		
</script>
	
