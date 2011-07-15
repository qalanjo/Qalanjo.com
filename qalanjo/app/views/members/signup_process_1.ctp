<div id="top-content">
      <p>You have succesfully taken the first step towards finding a successful relationship. The result of this test will provide you with insights about yourself and will enable us to find matches for you.</p>
      <p>Take as much time as you need to as you answer the questions as honest as possible. Remember, you can save your work and go back to the exact same page later on.</p>
</div>
<div id="top-title">
      <p><?php echo $step?></p>
</div>

<div id="bottom-content">
	<?php
		echo $this->Session->flash();
		echo $this->Form->create("Member", array("id"=>"signup_form", "class"=>"ui-helper-clearfix"));
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
			echo $this->Form->label("Member.lastname", "Name:");		
			echo "</div>";
			echo "<div class=\"col-2 2col\">";
				echo $this->Form->input("Member.firstname", array("label"=>false, "div"=>false, "class"=>"name"));
				
				echo $this->Form->input("Member.lastname", array("label"=>false, "div"=>false, "value"=>"Last Name", "id"=>"lastname", "class"=>"name"));
			echo "</div>";
		echo "</div>";
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
			echo $this->Form->label("Member.gender_id", "I am:");		
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.gender_id", array("label"=>false, "div"=>false, "type"=>"select", "options"=>$genders));
				echo $this->Form->label("Member.looking_for_id", "Seeking for a:");
				echo $this->Form->input("Member.looking_for_id", array("label"=>false, "div"=>false,  "type"=>"select", "options"=>$genders));
			echo "</div>";
		echo "</div>";
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.country_id", "Where are you now:");
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.country_id", array("div"=>false, "label"=>false, "type"=>"select", "options"=>$countries, "id"=>"country"));				
			echo "</div>";
		echo "</div>";
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.state", "State/Province:");
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.state", array("div"=>false, "label"=>false, "class"=>"location"));			
			echo "</div>";
		echo "</div>";
		
		/*
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.city", "City:");
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.city", array("div"=>false, "label"=>false, "class"=>"location"));				
			echo "</div>";
		echo "</div>";
		
		
			
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.zipcode", "Zip Code:");
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.zipcode", array("div"=>false, "label"=>false));		
			echo "</div>";
		echo "</div>";
		
		*/
		
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.email", "Email:");		
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.email", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";
		
		
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.confirm_email", "Confirm Email:");
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.confirm_email", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";

		
		
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.password", "Password:");
	
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.password", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";
		
		/*
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.confirm_password", "Confirm Password:");
	
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.confirm_password", array("div"=>false, "label"=>false, "type"=>"password"));	
			echo "</div>";
		echo "</div>";
		*/
		
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.secret_question_id", "Secret Question:");
	
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.secret_question_id", array("div"=>false, "label"=>false, "type"=>"select", "options"=>$secret_questions));	
			echo "</div>";
		echo "</div>";
		
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.secret_answer", "Secret Answer:");
	
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.secret_answer", array("div"=>false, "label"=>false));	
			echo "</div>";
		echo "</div>";
	
		echo "<div class=\"bc-wrap2\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("Member.idea_id", "Where did you hear about us?");	
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $this->Form->input("Member.idea_id", array("label"=>false, "div"=>false));
			echo "</div>";
		echo "</div>";
		
		echo "<div class=\"bc-wrap2 bc-wrap4\">";
			echo"<div class=\"col-1\">";
				echo $this->Form->label("", "Security Code:");
			echo "</div>";
			echo "<div class=\"col-2\">";
				echo $recaptcha->display_form('echo');
			echo "</div>";
		echo "</div>";
		
		?>
		<div id="terms-condition">
			<p><strong>Terms and Condition:</strong> By clicking the button below, I certify that I have read and agree to the Qalanjo Terms of Service, Qalanjo Privacy and Policy and Communication Terms Service, and to receive account related communications from Qalanjo electronically. Qalanjo automatically identifies items such as words, links, people, and subjects from your Qalanjo communications services to deliver product features and relevant advertising.</p>
		</div>
		<?php 
		echo $this->Form->input("Member.agree", array("label"=>"I agree with the terms and conditions", "type"=>"checkbox", "div"=>"check"));
				
		echo "<div id=\"buttons\">";
			echo $this->Form->submit(" ", array("div"=>false));
					
        echo "</div>";
		
		echo $this->Form->end();
	?>

</div>

<?php echo $this->element("scripts/country_trigger")?>
