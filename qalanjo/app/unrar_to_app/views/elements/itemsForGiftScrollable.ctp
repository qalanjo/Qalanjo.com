
<?php if(!empty($type['Gift'])):?>
	
	<div id = 'divForItemNo<?php echo $type['Gift'][sizeof($type['Gift'])-1]['id'];?>'>
		<?php if($type['EOF'] == 1):?>
			<?php $eof = $type['EOF'];?>
		<?php else:?>
			<?php $eof = 0;?>
		<?php endif;?>
		<?php 
			echo $this->Html->image("gifts/seeMoreButton.png", array("height"=>"83",'width'=>'83',"url"=>"#","div"=>false));
		?>
		<?php foreach($type['Gift'] as $gift):?>
			
			<?php 
				echo $this->Html->image("gifts/".$gift['picture_path'], array("height"=>"83","url"=>"#","div"=>false));
				// image of the gifts inside the category
			?>
			
		<?php endforeach;?>
		
	</div>
<?php endif;?>
