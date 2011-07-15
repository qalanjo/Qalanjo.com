<p>Hi, <?php echo $member["Member"]["firstname"]?></p>
	<p>Thank you for registering at Qalanjo.</p>
	<p>Your password is <strong><?php echo $password?>.</strong></p>
<p>
	Before you can login, you must first activate your account by selecting the following link:
	<?php echo $this->Html->link("Click me", "http://www.qalanjo.com/activate/".$member["Member"]["id"]."/".$member["Member"]["activation_code"])?>
</p>
<br/>
<p>Thank you</p>
<br/>
<p><strong>The Qalanjo Team</strong></p>

