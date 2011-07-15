<?php echo $session->flash();?>

<div id="updatable_div">
      <div id="contentarea">
        <!--center content here-->
      	<div id="mainContent">
      		<?php 
			if (isset($partner['Partner']["MemberProfile"]["picture_path"])&&$partner['Partner']["MemberProfile"]["picture_path"]!=""){
				$image = $this->Html->image("uploads/".$partner['Partner']["id"]."/default/profile_thumb_".$partner['Partner']["MemberProfile"]["picture_path"],array('class'=>'partner_picture'));
			}else{
				if ($partner['Partner']["Gender"]["value"]=="Man"){
					$image = $this->Html->image("designs/member/profile/silhoutte_boy.png",array('class'=>'partner_picture'));
				}else{
					$image = $this->Html->image("designs/member/profile/silhoutte_girl.png",array('class'=>'partner_picture'));	
				}
			}?>
			<?php echo $image;?>
			<?php echo $partner['Partner']['firstname'].' '.$partner['Partner']['lastname'];?>
			<?php echo $this->Form->create('SentGift',array('inputDefaults'=>array('div'=>false,'legend'=>false),'url'=>array('controller'=>'gifts','action'=>'gift_customization')));?>
			
			
       	 	<p>Select gifts to send to your partner</p>
			<?php $options = array();?>
			<?php foreach($in_stock as $gift):?>
				<?php if($gift['ShoppedItem']['quantity'] != 0):?>
					<?php $options[$gift['Gift']['id']] = $this->Html->image('gifts/'.$gift['Gift']['picture_path'],array('width'=>52,'div'=>false))
						.' '.$gift['Gift']['name'];?>
				<?php endif;?>
			<?php endforeach;?>
			<?php echo $this->Form->input('gift_id',array('options'=>$options,'type'=>'select','multiple'=>'checkbox','div'=>false,'escape'=>false,'label'=>false));?>
			<?php echo $this->Form->input('member_id',array('value'=>$partner['Partner']['id'],'type'=>'hidden'));?>
			<?php echo $this->Form->end('Customize');?>
      	</div>
      </div>
</div>