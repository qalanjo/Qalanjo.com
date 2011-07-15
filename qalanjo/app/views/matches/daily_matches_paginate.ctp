<?php 
$this->Paginator->options(array(
    'update' => '#matches',
    'evalScripts' => true
));
?>
<?php 
	foreach($matches as $match){
		$matched = $match["Matched"];
	?>

	<div class="quick_match span-15 last">
		<div class="span-3">
			<?php 
				if (isset($matched["MemberProfile"]["picture_path"])&&$matched["MemberProfile"]["picture_path"]!=""){
					echo $this->Html->image("uploads/".$matched["id"]."/default/profile_thumb_".$matched["MemberProfile"]["picture_path"]);
				}else{
					if ($matched["Gender"]["value"]=="Man"){
						echo $this->Html->image("designs/member/profile/silhoutte_boy.png");
					}else{
						echo $this->Html->image("designs/member/profile/silhoutte_girl.png");	
					}
					
				}
			?>
	
		</div>
		<div class="span-8 prepend-1">
			<div class="span-8 last">
				<h2 class="match_name">
					<?php 
						$name = $matched["firstname"]." ".$matched["lastname"];
						echo $this->Html->link($name, "/profile/".$matched["id"]);
						$age = $this->requestAction("/member_profiles/getAge/".$matched["id"]);
						echo ", ".$age[0][0]["age"]." years old"
					?>
				
				</h2>
			</div>
			<div class="span-8 last match_status">
				<h2 class="status"><?php echo $matched["MemberProfile"]["status"]?>
				</h2>	
			</div>
		</div>
		<div class="span-3 last">
			<div class="span-3 last">
				<p>
					<?php 
						if ($matched["Gender"]["value"]=="Man"){
							echo "He's";
						
						}else{
							echo "She's";
						}
					?>
					a match.
				</p>
			</div>
			<div class="span-2 last">
				<?php 
					echo $this->Html->link("View Profile", "/profile/".$matched["id"]);
				?>
			</div>
			
		
		</div>
		
	</div>
<?php 			
	}

?>
<div class="paging clear">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>