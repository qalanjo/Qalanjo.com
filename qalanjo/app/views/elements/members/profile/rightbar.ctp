<div id="content-sidebar" class="span-4 last">
		<?php if (count($weights)!=0){?>
			<div id="topic-openers" class="sidebar_block">
				<div class="sidebar-title calign"><h3>TOPIC OPENERS</h3></div>
				<div id="topic-wrap">
				<div id="topic-openers-content">
				<?php
					foreach($weights as $weight){
						echo "<p>".$weight["MemberAttributeWeight"]["interpretation"]."</p>";	
					}
			
				?>
				</div>
				</div>
		
			</div>
		<?php }?>
</div>