<div class="right-container left"> 
		<h2 class='match-header left'> 
			<span class="left">My Matches' Photo</span>	
		</h2> 
	<?php if(@$myMatches) { ?>
		<?php foreach($myMatches as $k => $matches) { ?>
		<div class="left clear album-match"> 
		<ul>
			<?php foreach($matches as $key => $match) { ?>
				<?php if(is_int($key)) { ?>
				<li> 
					<?php echo $html->image(str_replace('//','/',$uploadsPath . '/' . $match['Photo']['member_id'] . '/' . $match['Photo']['albumName'] . '/thumb_' . $match['Photo']['picture_path']),
										array('url'=>'/photos/album/' . $match['Photo']['album_id']));?> 
				</li> 
				<?php } //end if ?>
			<?php }//end foreach ?>
		</ul>
			<span class="left clear name"> 
						<strong>By:</strong> <?php echo $html->link($matches['name'], '/members/profile/' . $matches[$k]['Photo']['member_id']); ?>
			</span>
		</div>	
		<?php } //end foreach ?>
	<?php } //end if ?>
		<h2 class='match-header sponsors left clear'> 
			<span class="left">Sponsors</span>	
		</h2>		
		
		<div class="ads left clear"> 
			
		</div>			
</div> <!-- end right-container -->