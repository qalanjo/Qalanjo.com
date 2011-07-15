<?php 
	$path = "designs/blue/members/index/";
?>
<dl class="left gift-box-list">
	<dt class="left"><em>Sender</em></dt>
	<dd class="left">
		<div class="left icebreaker-profile-info gift-info-box">
			<div class="profile-picture left">
				<div class="profile-picture-bg left">
					<?php 
						if (isset($sentGift["MemberProfile"]["picture_path"])||($sentGift["MemberProfile"]["picture_path"]!="")){
							echo $this->Html->image("uploads/".$sentGift["Sender"]["id"]."/default/profile_thumb_".$sentGift["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$sentGift["Sender"]["id"]));
						}else{
							if ($sentGift["Sender"]["gender_id"]==1){
								echo $this->Html->image($path."default.jpg", array("url"=>"/view_members/profile/".$sentGift["Sender"]["id"]));
							}else{
								echo $this->Html->image($path."woman-default-picture.jpg", array("url"=>"/view_members/profile/".$sentGift["Sender"]["id"]));
							}
						}
					?>
					</div>
			</div>
			<div class="profile-info left">
				<h4 class="left">
					<?php echo $sentGift["Sender"]["firstname"]." ".$sentGift["Sender"]["lastname"]?>
				</h4>
				<?php if (($sentGift["Sender"]["address1"]!="")&&($sentGift["Sender"]["address2"]!="")&&($sentGift["Sender"]["city"]!="")){?>
					<span class="left clear location">
						<?php echo $sentGift["Sender"]["address1"].", ".$sentGift["Sender"]["address2"].", ".$sentGift["Sender"]["city"]?>
					</span>
				<?php }?>
				<span class="left clear location">
					<?php echo $sentGift["Sender"]["state"]?>
				</span>
			</div>
		</div>
	</dd>
	<?php if ($sentGift["SentGift"]["message"]!=""){?>
		<dt class="left clear">
			<em>Message</em>
		</dt>
		<dd class="left message">
			<?php echo $sentGift["SentGift"]["message"]?>
		</dd>
	<?php }?>
	<dt class="left clear">
		Special Gift
	</dt>
	<dd class="left">
		<hr/>
	</dd>
	<dt class="left clear">
		<?php echo $html->image('gifts/category/' . strtolower($typeName) . '/thumbnails/' . $sentGift['Gift']['picture_path']); ?>
	</dt>
	<dd class="left gift-info">
		<h2><?php echo $sentGift["Gift"]["name"]?></h2>
		<p>
		<?php echo $sentGift["Gift"]["description"]?>
		</p>
	</dd>
</dl>
