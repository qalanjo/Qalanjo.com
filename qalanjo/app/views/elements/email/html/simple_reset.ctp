<p>Hi, <?php echo $member["Member"]["firstname"]?></p>
<p>
	To reset your password, click the link provided:
	<?php echo $this->Html->link("Click me", "http://www.qalanjo.com/reset/".$member["Member"]["reset_code"])?>
</p>
<br/>
<p>Thank you</p>
<br/>
<p><strong>The Qalanjo Team</strong></p>

