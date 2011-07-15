<div id="centercontent">
	<div id="main_display">
		<div id="signup">
			<h1>Sign Up</h1>
			<span class='subheader'>Find your match for <strong>FREE</strong></span>
			<fieldset>
			<?php 
				echo $this->Session->flash();
				echo $this->Form->create("Member", array("action"=>"signup"));
				echo $this->Form->input("Member.firstname", array("label"=>"First Name:", "div"=>"input"));
				echo "<div class='inline_spec'>";
				echo $this->Form->input("Member.gender_id", array("label"=>"I am:", "div"=>"inline_div", "type"=>"select", "options"=>$genders));
				echo $this->Form->input("Member.looking_for_id", array("label"=>"seeking for a", "div"=>"inline_div reduce",  "type"=>"select", "options"=>$genders));
				echo "</div>";
				echo $this->Form->input("Member.zipcode", array("label"=>"Zip Code:", "div"=>"input"));
				echo $this->Form->input("Member.country", array("label"=>"Country:", "type"=>"select", "options"=>$countries, "div"=>"input"));
				echo $this->Form->input("Member.email", array("label"=>"Email:", "div"=>"input"));
				echo $this->Form->input("confirmemail", array("label"=>"Confirm Email:", "div"=>"input"));
				echo $this->Form->input("Member.password", array("label"=>"Password:", "div"=>"input"));
				
				echo $this->Form->input("Member.idea_id", array("label"=>"Where :", "type"=>"select", "options"=>$ideas, "div"=>"input"));
				echo $this->Form->end(" ", array("id"=>"signup_button"));
				
				?>
			</fieldset>
		</div>
	</div>
	<div id="details_display">
		<!-- Steps -->
		<div id="steps">
			<h1>4 Steps to Find Your Match</h1>
			<div>
				<div class='step'>
					<?php echo $this->Html->image("home/1.png")?>
					<p>Fill out your personal information</p>
				</div>
				<div class='step'>
					<?php echo $this->Html->image("home/2.png")?>
					<p>Answer the lifestyle assessment</p>
				</div>
				<div class='step' style="width:230px">
					<?php echo $this->Html->image("home/3.png")?>
					<p>Answer the personality questions</p>
				</div>
				<div class='step'>
					<?php echo $this->Html->image("home/4.png")?>
					<p>Find your soulmate in no time</p>
				</div>
				
			</div>
		</div>
		<!--  -->
		<div id="bottom" style='margin-top:30px'>
			<?php echo $this->Html->image("home/qalanjo advice.png", array("class"=>"advice_pic"))?>
			<div class='advice_block'>
				<div class='content'>
				<?php echo $this->Html->image("home/couple shadow.png")?>
					<span class='title'>Know your perfect match</span>
					<p>Perfect… Being complete of its kind and without defect or blemish is called perfect; but perfect match? That's the question puzzled in every one's mind now. Remember that no one in this world born "Perfect" we are just a human being that can commit mistakes and everyone is different from each other... more. </p>
				
				</div>
			</div>
			<div class='advice_block'>
				<?php echo $this->Html->image("home/stair.png")?>
				<div class='content'>
					<span class='title'>Take the stairs of Love</span>
					<p>In our simple and daily routinely life, we don’t notice that we already developed what we called love. Although people would differ in showing love and affection in their unique way, but the purpose are almost the same. Love would start within us and basically has its own stepladder to step on.  more. </p>
				</div>
			</div>
		</div>
	</div>
</div>