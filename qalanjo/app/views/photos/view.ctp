<?php 
	echo $this->element('photos/upload-dialog');
	//debug($myMatches);
?>
<div class="content-container"> 
					<div class="album-container left"> 
						<div class="left-container left"> 
							<h1 class='left'>My Albums</h1> 
							<div class="left clear by"> 
								<strong>By:</strong> 
									<span class='name'>
										<?php echo $html->link($profileInfo['Member']['firstname'] . ' ' . $profileInfo['Member']['lastname'], '/members/profile/' . $member_id);?>
									</span> 
							</div> 
							<div class="left clear controls" id="line"> 
								<span class="left"></span> 
								<ul class="controls left"> 
									<li> 
									</li> 
									<li> 
									</li> 
								</ul>
							</div>
						<?php if(!$visitor) { ?>
							<div class="right clear upload"> 
								<button id="upload-photos" class="cursor"> 
									
								</button> 
							</div>
						<?php } //end if ?>
							<div id="album-list" class="clear left"> 
								<ul class="albums"> 
									<?php foreach($myAlbums as $id => $album) {?>
									<li> 
										<div class="photo-album-bg"> 
											<?php 
											if(!$album['cover_pic']) {
												echo $this->Html->image('photos/emptyalbum.png', array('url'=>'album/'.$id));	
											} else {
												echo $this->Html->image(str_replace('//','/', $uploadsPath .'/'.$member_id.'/'.$album['name'].'/thumb_'. $album['cover_pic']),
														array('url'=>'album/'.$id));
											}
											?>
										</div> 
										<span class="name"> 
											<?php echo $album['name']?>
										</span> 
										<span class="count"> 
											<?php
												 //set plural/singular.. pic count
												$count =  ($album['pic_count'] == 0 ? 'No' : $album['pic_count'] );
												echo $count;
												$word = ($album['pic_count'] > 1 ? ' photos' : ' photo');
												echo $word;
											?> 
										</span> 
									</li> 
									<?php } //end foreach ?>
								</ul> 
							</div> 
							
						</div> <!-- end left-container -->
						<?php echo $this->element('photos/right-container');?>
					</div><!-- end album-container -->
</div> <!-- end content-container -->
