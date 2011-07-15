<div id="bottom-content" class="span-24 last container signup">
	<div class="span-24 last form">
	
	
	<?php
		echo $this->Session->flash();
	?>
		<p class="prepend-1 span-10 last instruction"><strong>Kindly fill out this form before we proceed to finding you a perfect match.</strong></p>
		<div class="container span-10 prepend-1">
			
		
		</div>
		
	<?php
		
		echo $this->Form->create("Member", array("id"=>"signup_form"));
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.firstname", "First Name:");	
			echo "</div>";	
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.firstname", array("label"=>false, "div"=>false, "id"=>"firstname", "class"=>"name"));
			echo "</div>";
		echo "</div>";
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.lastname", "Last Name:") . "<br /><br />";
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.lastname", array("label"=>false, "div"=>false, "class"=>"name", "id"=>"lastname",));
			echo "</div>";				
		echo "</div>";
		
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
			echo $this->Form->label("Member.gender_id", "I am:");		
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.gender_id", array("label"=>false, "div"=>false, "type"=>"select", "options"=>$genders, "class"=>"inline"));
				echo $this->Form->label("Member.looking_for_id", "Looking for ");
				echo $this->Form->input("Member.looking_for_id", array("label"=>false, "div"=>false,  "type"=>"select", "options"=>$genders_opposite, "class"=>"inline"));
			echo "</div>";
		echo "</div>";
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.country_id", "Where are you now:");
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.country_id", array("div"=>false, "label"=>false, "type"=>"select", "options"=>$countries, "id"=>"country"));				
			echo "</div>";
		echo "</div>";
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.state", "State/Province:");
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.state", array("div"=>false, "label"=>false, "class"=>"location"));			
			echo "</div>";
		echo "</div>";
		
		/*
		echo "<div class=\"span-18 append-3 prepend-3 last\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.city", "City:");
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.city", array("div"=>false, "label"=>false, "class"=>"location"));				
			echo "</div>";
		echo "</div>";
		
		
			
		echo "<div class=\"span-18 append-3 prepend-3 last\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.zipcode", "Zip Code:");
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.zipcode", array("div"=>false, "label"=>false));		
			echo "</div>";
		echo "</div>";
		
		*/
		
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.email", "Email:");		
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.email", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";
		
		
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.confirm_email", "Confirm Email:");
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.confirm_email", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";

		
		
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.password", "Password:");
	
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.password", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";
		
		/*
		echo "<div class=\"span-18 append-3 prepend-3 last\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.confirm_password", "Confirm Password:");
	
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.confirm_password", array("div"=>false, "label"=>false, "type"=>"password"));	
			echo "</div>";
		echo "</div>";
		*/
		
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.secret_question_id", "Secret Question:");
	
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.secret_question_id", array("div"=>false, "label"=>false, "type"=>"select", "options"=>$secret_questions));	
			echo "</div>";
		echo "</div>";
		
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.secret_answer", "Secret Answer:");
	
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.secret_answer", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";
	
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("Member.idea_id", "Where did you hear about us?");	
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $this->Form->input("Member.idea_id", array("label"=>false, "div"=>false));
			echo "</div>";
		echo "</div>";
		
		echo "<div class=\"span-18 append-3 prepend-3 last row\">";
			echo"<div class=\"span-5 prepend-1\">";
				echo $this->Form->label("", "Security Code:");
			echo "</div>";
			echo "<div class=\"span-10 last last\">";
				echo $recaptcha->display_form('echo');
			echo "</div>";
		echo "</div>";
		
		?>
		<div id="terms-condition" class="span-18 append-3 prepend-3 last row">
			<p class="prepend-1 span-16 append-1 last"><strong>Terms and Condition:</strong> By clicking the button below, I certify that I have read and agree to the Qalanjo Terms of Service, Qalanjo Privacy and Policy and Communication Terms Service, and to receive account related communications from Qalanjo electronically. Qalanjo automatically identifies items such as words, links, people, and subjects from your Qalanjo communications services to deliver product features and relevant advertising.</p>
		</div>
		<?php 
		echo $this->Form->input("Member.agree", array("label"=>"I agree with the terms and conditions", "type"=>"checkbox", "div"=>"check span-16 prepend-1 last"));
				
		?>
		<?php 
		echo "<div id=\"buttons\" class='clear'>";
			echo $this->Form->submit("Save", array("div"=>false));
					
        echo "</div>";
		
		echo $this->Form->end();
	?>
	</div>
</div>

<?php echo $this->element("scripts/country_trigger")?>
