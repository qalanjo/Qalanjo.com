<?php 
$this->Paginator->options(array(
    'update' => '#viewers_list',
    'evalScripts' => true
));
?>
<!-- Element for loading list of viewers. -->
<?php
	$i=0;
	foreach($viewers as $viewer){
		if ($i%4==0){
			if ($i!=0){
				echo "</div>";
			}
			echo "<div class=\"span-15 last list\">";
		}
		$i++;
		$profile = $this->requestAction("/member_profiles/getProfileOnly/".$viewer["ViewActivity"]["viewer_id"]);
		?>
		<div class="who_viewed span-3 left">
			<?php 
				$link = $profile["MemberProfile"]["picture_path"];
				if ($link!=""){
					echo $this->Html->image("uploads/{$viewer["ViewActivity"]["viewer_id"]}/profile_thumb_".$link, array("url"=>"/profile/{$viewer["ViewActivity"]["viewer_id"]}"));
				}else{
					if ($viewer["Viewer"]["gender_id"]==1){
						echo $this->Html->image("designs/member/profile/silhoutte_boy.png");	
					}else{
						echo $this->Html->image("designs/member/profile/silhoutte_girl.png");
					}
				}
			?>
			<p class="span-3 last small">
				<?php 
					$age = $this->requestAction("/member_profiles/getAgeV2/".$viewer["ViewActivity"]["viewer_id"]);
					if ($age!=""){
						echo $viewer["Viewer"]["firstname"]." ".$viewer["Viewer"]["lastname"].", ".$age." years old";
					}else{
						echo $viewer["Viewer"]["firstname"]." ".$viewer["Viewer"]["lastname"];
					}
					 
					 ?>
			</p>
			<p class="span-3 last small">
				<?php echo $this->Html->link("View Profile", "/profile/".$viewer["ViewActivity"]["viewer_id"])?>
			</p>
			<p class="span-3 last small">
				<?php echo $this->Html->link("Send Message", "#", array("onclick"=>"message_viewer({$viewer["ViewActivity"]["viewer_id"]})"))?>
			</p>
			<p class="span-3 last small">
				<?php echo $this->Html->link("Wink", "#", array("onclick"=>"askAndWinkMe({$viewer["ViewActivity"]["viewer_id"]})"))?>
			</p>
			
		</div>
		
		<?php 		
	}	
	if ($i%4!=0){	
		echo "</div>";	
	}
?>

<div class="clear">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
