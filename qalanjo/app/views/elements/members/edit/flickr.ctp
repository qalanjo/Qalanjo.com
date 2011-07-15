<script type="text/javascript">
//<![CDATA[
	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=<?php echo urlencode($description)?>&format=json&jsoncallback=?", function(data) {
		var loaded=false;

		$.each(data.items, function(i,loaded){
			$('#<?php echo $picture;?>').attr("src",loaded.media.m).height(100).width(100);
			loaded = true;
			return (i == 0) ? false : null;
		});

		<?php /* 
		if (!loaded){

			
			
				if (isset($type)){
					if ($type=="Music"){
						$path = $this->Html->url("/img/designs/member/profile/music_not_loaded.png");
					}else{
						$path = $this->Html->url("/img/designs/member/profile/loaded.png");	
					}
				}else{
					$path = "";
				}
			?>
				
				
				
			$('#<?php echo $picture;?>').attr("src",<?php echo $path?>).height(100).width(100);	
			
			


			
		}

		 */?>
		
	});
//]]>
</script>