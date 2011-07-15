<div class="logo left">
</div>
<div class="login-space right" id="login-space">
    <div class="login">
   	 	<?php echo $this->Form->create("Member", array("url"=>"login", "class"=>"left"))?>
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
                <a href="#">I can't access my
                    account</a>
                | <a href="#">Help</a>
            </div>
        <?php echo $this->Form->end();?>
    </div>
    <div class="login-button">
        <button id="login-button" class="button-login left">
            Member Login  <?php 
                	echo $this->Html->image("/css/img/blue/homepage/triangle.png")?>
        </button>
    </div>
</div>
<div class="signup-form left">
    <div class="right sign-up-header clear">
        <div class="signup-slice-corner right">
        </div>
        <div class="signup-repeat-header right">
            <h2 class="left">Free to Review Your Matches</h2>
        </div>
        <div class="signup-slice-corner-left right">
        </div>
    </div>
    <div class="signup-form-content left">
    	<?php echo $this->Form->create("Member", array("url"=>"signup", "id"=>"signup-form"))?>	
            <fieldset class="left">
                <dl class="left">
                    <dt class="left">
                        <label for="firstName">
                            First Name: 
                        </label>
                    </dt>
                    <dd class="left">
                    	<?php 
							echo $this->Form->input("firstname", array("class"=>"text", "div"=>false, "label"=>false));
						?>
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="lastName">
                            Last Name: 
                        </label>
                    </dt>
                    <dd class="left">
                        <?php 
							echo $this->Form->input("lastname", array("class"=>"text", "div"=>false, "label"=>false));
						?>
                        
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="email">
                            Email: 
                        </label>
                    </dt>
                    <dd class="left">
                    	<?php 
							echo $this->Form->input("email", array("class"=>"text", "div"=>false,"id"=>"email", "label"=>false));
						?>
						<span class="footnote">Note: Your email is
                            used to log back in</span>
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="confirmEmail">
                            Confirm Email: 
                        </label>
                    </dt>
                    <dd class="left">
                        <?php echo $this->Form->input("confirm_email", array("id"=>"confirm_email", "div"=>false, "label"=>false))?>
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="password">
                            Password: 
                        </label>
                    </dt>
                    <dd class="left">
                    	<?php echo $this->Form->input("password", array("id"=>"password","type"=>"password", "div"=>false, "label"=>false, "selected"=>""))?>
                       <span class="footnote">Must be atleast 5 characters</span>
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="gender" class="gender first">
                            I'm a:
                        </label>
                    </dt>
                    <dd class="left gender">
                    	<?php 
							echo $this->Form->input("gender_id", array("class"=>"gender", "type"=>"select", "options"=>$genders,"div"=>false, "label"=>false));
						?>
                    </dd>
                    <dt class="left gender-label">
                        <label for="gender" class="gender first">
                            Seeking: 
                        </label>
                    </dt>
                    <dd class="left gender">
                        <?php 
							echo $this->Form->input("looking_for_id", array("class"=>"gender", "type"=>"select", "options"=>$seeking,"div"=>false, "label"=>false));
							
						?>
                    </dd>
                    <dt class="left clear">
                        <label for="password">
                            Country: 
                        </label>
                    </dt>
                    <dd class="left">
                    	<?php 
							echo $this->Form->input("country_id", array("id"=>"country", "type"=>"select", "options"=>$countries,"div"=>false, "label"=>false, "selected"=>"236"));
						?>
                        
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="state">
                            State: 
                        </label>
                    </dt>
                    <dd class="left">
                   		 <?php 
							echo $this->Form->input("Member.state", array("type"=>"select", "options"=>$states, "label"=>false, "div"=>false, "id"=>"state"))
						
						?>
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="confirmEmail">
                            Zip Code: 
                        </label>
                    </dt>
                    <dd class="left">
	                    <?php echo $this->Form->input("zipcode", array("id"=>"zipcode", "div"=>false, "label"=>false))?>
                        <label class="required">
                        </label>
                    </dd>
                    <dt class="left clear">
                        <label for="findEH">
                            How did you hear about us?:
                        </label>
                    </dt>
                    <dd class="left">
                        <?php 
							echo $this->Form->input("idea_id", array("class"=>"findEH", "id"=>"findEH", "type"=>"select", "options"=>$ideas, "div"=>false, "selected"=>"-1","label"=>false));
						?>
                        <label class="required">
                        </label>
                    </dd>
                </dl>
                <?php echo $this->Form->button("", array("type"=>"submit", "class"=>"left", "id"=>"find-my-matches"))?>
            </fieldset>
        <?php echo $this->Form->end()?>
    </div>
</div>
<div class="right why-qalanjo">
    <h2>Why Qalanjo</h2>
</div>
<div class="why-qalanjo-pointer right">
</div>
<div class="left item-features clear">
    <div class="item-feature item-feature-first left">
        <div class="left item-shadow item-shadow-left">
        </div>
        <div class="left item-content">
            <div class="left content">
                <h3 class="left">Find the Perfect Person for You</h3>
                 <?php 
                	echo $this->Html->image("/css/img/blue/homepage/paper.png", array("alt"=>"", "class"=>"right clear paper"))
                	
                ?>
                <p class="left clear">
                    Sign up and register in our website, complete the
                    relationship questionnaire and create your own personal profile
                    absolutely free.
                </p>
            </div>
        </div>
        <div class="left item-shadow item-shadow-right">
        </div>
    </div>
    <div class="item-feature left">
        <div class="left item-shadow item-shadow-left">
        </div>
        <div class="left item-content">
            <div class="left content">
                <h3 class="left">Meet People of Your Own Kind</h3>
                 <?php 
                	echo $this->Html->image("/css/img/blue/homepage/woman.png", array("alt"=>"", "class"=>"right clear woman"))
                	
                ?>
                <p class="left clear">
                    Since Qalanjo is an exclusive dating site for
                    Somali people, you are assured to find the perfect person..
                </p>
            </div>
        </div>
        <div class="left item-shadow item-shadow-right">
        </div>
    </div>
    <div class="item-feature left">
        <div class="left item-shadow item-shadow-left">
        </div>
        <div class="left item-content">
            <div class="left content">
                <h3 class="left search">Search for Somali Singles Online</h3>
                <?php 
                	echo $this->Html->image("/css/img/blue/homepage/somali.png", array("alt"=>"", "class"=>"right clear somali"))
                	
                ?>
                <p class="left clear">
                    This site is highly useful especially to Somali
                    singles who are very busy in their respective careers and professions
                    which..
                </p>
            </div>
        </div>
        <div class="left item-shadow item-shadow-right">
        </div>
    </div>
    <div class="item-feature left">
        <div class="left item-shadow item-shadow-left">
        </div>
        <div class="left item-content">
            <div class="left content">
                <h3 class="left search">Find True Compatibility Today</h3>
                <?php 
                	echo $this->Html->image("/css/img/blue/homepage/mansearch.png", array("alt"=>"", "class"=>"right clear mansearch"))
                	
                ?>
                <p class="left clear">
                    Isn't it time you experienced the joy of falling
                    in love with someone who sees you, loves you, and accepts you for who
                    you are?
                </p>
            </div>
        </div>
        <div class="left item-shadow item-shadow-right">
        </div>
    </div>
</div>
