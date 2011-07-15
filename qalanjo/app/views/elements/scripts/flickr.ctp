<script>
$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=nebula&format=json&jsoncallback=?", function(data) {
	$.each(data.items, function(i,item){
	$("<img/>").attr("src",item.media.m).appendTo("#flickr").height(100).width(100);
		return (i == 5) ? false : null;
	});
});
</script>