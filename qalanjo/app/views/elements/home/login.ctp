<?php echo $this->Form->create("Member", array("url"=>"login", "class"=>"left", "id"=>"loginForm"))?>
            <fieldset class="left">
                <dl class="left">
                    <dt class="left">
                        Email:
                    </dt>
                    <dd class="left clear">
                    	<?php 
							echo $this->Form->input("Member.email", array("div"=>false,
												 "label"=>false, "class"=>"txt", "maxlength"=>50, "id"=>"email-login"));
						?>
                    </dd>
                    <dt class="left clear">
                        Password:
                    </dt>
                    <dd class="left clear">
                        <?php 
							echo $this->Form->input("Member.password", array("div"=>false, "type"=>"password",
												 "label"=>false, "class"=>"txt", "maxlength"=>50, "id"=>"password-login"));
						?>
                    </dd>
                </dl>
                <button class="right logged-button clear" type="submit">
                </button>
            </fieldset>
 	<div class="right small small-links clear">
		<?php echo $this->Html->link("I can't access my account", "/members/forgot_password")?>
		| <a href="#">Help</a>
	</div>
<?php echo $this->Form->end();?>