<?php 
	$this->Html->css("blue/matches-page-style", "stylesheet", array("inline"=>false));
	$this->Javascript->link("blue/matches/index", false);
?>
<div class="content-container">
	<div class="matches-page-header">
		<h2>My Matches</h2>
		<ul>
			<li>
				<?php echo $this->Html->link("Find New Matches", "/matches")?>&nbsp;|&nbsp;
			</li>
			<li>
				<?php echo $this->Html->link("Edit Match Settings", "/members/match_settings")?>
			</li>
		</ul>
	</div>
	<div class="main-content">
		<div class="main-content-tab">
			<ul id="tab">
				<li class="active">
					<a id="new_tab_nav">
						<span class="tab-left"></span>
						<span>New</span>
						<span class="tab-right"></span>
					</a>
				</li>
				<li>
					<a id="communicating_tab_nav">
						<span class="tab-left"></span>
						<span>Communicating</span>
						<span class="tab-right"></span>
					</a>
				</li>
				<li>
					<a id="archive_tab_nav">
						<span class="tab-left"></span>
						<span>Archived</span>
						<span class="tab-right"></span>
					</a>
				</li>
			</ul>
		</div>
		<div class="tab-content-container-top">
		</div>
		<div class="search-bar">
			<?php 
				echo $this->Form->create("Match", array("id"=>"search_form"));			
				echo $this->Form->input("search", array("div"=>false, "label"=>"Search:", "id"=>"search_match"));
				echo $this->Form->button("Search", array("type"=>"submit", "div"=>false));
			?>
				<a href="#" id="clear_search">Clear Search</a>
			<?php 
				echo $this->Form->end();
			?>
		</div>
		<div class="controls-and-settings">
			<div class="setting">
				<label for="sort-by">Sort by:</label>
				<select name="sort-by" id="sort-by">
					<option>Match Delivery Rate(Recent)</option>
				</select>
			</div>
			<div class="setting">
				<label for="display">Display:</label>
				<select name="display" id="display">
					<option value="10">10 Matches per page</option>
					<option value="20">20 Matches per page</option>
					<option value="30">30 Matches per page</option>
					<option value="40">40 Matches per page</option>
				</select>
			</div>
			<div class="control">
				<span>Showing <span id="start_index"></span> - <span id="record_count"></span> of <span id="max_count"></span> matches</span>
				<button id="previous">Previous</button>
				<button id="next">Next</button>
			</div>
		</div>
		<?php 
			
			if ($role_id==2){
		?>
				<div class="banner">
					<?php echo $this->Html->image("designs/blue/matches/encourage.jpg")?>
				</div>
		<?php 
			}
		?>
		<div id="matches-list" class="matches-list">
			
		</div>
	</div>
</div>