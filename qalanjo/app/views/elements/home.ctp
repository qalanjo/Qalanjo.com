		<div id="container">
			<div id="header">
			</div>
			<div id="show_signup_login_page_toggle_button">
			</div>
			<div id="signup">
				<div class="slideshow">
					<div class="image_wrapper active"><img src="<?php echo $this->webroot; ?>img/pic01.png" /></div>
					<div class="image_wrapper"><img src="<?php echo $this->webroot; ?>img/pic02.png" /></div>
					<div class="image_wrapper"><img src="<?php echo $this->webroot; ?>img/pic03.png" /></div>
				</div>
				<div class="signup_form">
					<div  class="signup_form_container">
						<?php 
							echo $this->Form->create("Member", array('inputDefaults'=>array('label'=>false, 'div'=>false), 'action'=>'signup', 'method'=>'POST', 'id'=>'signup_form2'));
						?>
						<label class="input">
						<span>Firstname</span>
						<?php 
							echo $this->Form->input("Member.firstname", array("div"=>false, "label"=>false));
						?>
						</label>
						<label class="input">
						<span>Lastname</span>						
						<?php 
							echo $this->Form->input("Member.lastname", array("div"=>false, "label"=>false));
						?>
						</label>
						<label class="input">
						<span>Email</span>	
						<?php 
							echo $this->Form->input("Member.email", array("div"=>false, "label"=>false));
						?>
						</label>
						<?php 
							echo $this->Form->button("<span>Find My Match!</span>", array('type'=>'submit'));
							echo $this->Form->end();
						?>
					</div>
				</div>
			</div>
			<div id="login">
				<div id="login_form">
					<div class="login_form_container">
						
						<?php 
							echo $this->Form->create("Member", array('inputDefaults'=>array('label'=>false, 'div'=>false), 'action'=>'login', 'method'=>'POST', 'id'=>'login_form2'));
						?>
						<label class="input">
						<span>Email</span>	
						<?php 
							echo $this->Form->input("Member.email", array("div"=>false, "label"=>false));
						?>
						</label>
						<label class="input">
						<span>Password</span>	
						<?php 
							echo $this->Form->input("Member.password", array('type'=>'password', "div"=>false, "label"=>false));
						?>
						</label>
						<?php 
							echo $this->Form->button("<span>Login</span>", array('type'=>'submit'));
							echo $this->Form->end();
						?>
						
						
						
					</div>
				</div>
			</div>
			<div id="footer">
				<div class="footer_links">
					<strong>&copy; Qalanjo, Inc.</strong>
					<a href="#">Site Maps</a>
					<a href="#">How It Works</a>
					<a href="#">Media Center</a>
					<a href="#">Affiliates</a>
					<a href="#">Online Dating Safety Tips</a>
					<a href="#">Local</a>
					<a href="#">Help</a>
					<br />
					<a href="#">About Us</a>
					<a href="#">Why Qalanjo</a>
					<a href="#">Career</a>
					<a href="#">Privacy</a>
					<a href="#">Terms and Services</a>
					<a href="#">Feedback</a>
					<a href="#">Contact Us</a>
				</div>
				<div id="show_reasons_page_button" onclick="slideDownToReasonsPage()">
					<div id="lip">
					</div>
					<div id="why-choose-qalanjo">
						<p>Why Choose Qalanjo?</p>
					</div>
				</div>
			</div>
		</div>
		<div id="reasons">
			<div id="reasons_header">
				<div id="reasons_form_container">
					<div id="reasons_page_signup_form">
						<div  class="signup_form_container">
								<?php 
									echo $this->Form->create("Member", array('inputDefaults'=>array('label'=>false, 'div'=>false), 'action'=>'signup', 'method'=>'POST', 'id'=>'signup_form2'));
								?>
									<label class="input">
									<span>Firstname</span>
									<?php 
										echo $this->Form->input("Member.firstname", array("div"=>false, "label"=>false));
									?>
									</label>
									<label class="input">
									<span>Lastname</span>						
									<?php 
										echo $this->Form->input("Member.lastname", array("div"=>false, "label"=>false));
									?>
									</label>
									<label class="input">
									<span>Email</span>	
									<?php 
										echo $this->Form->input("Member.email", array("div"=>false, "label"=>false));
									?>
									</label>
								<?php 
									echo $this->Form->button("<span>Find My Match!</span>", array('type'=>'submit'));
									echo $this->Form->end();
								?>
						</div>
					</div>
					<div id="show_signup_page_button" onclick="slideUpToSignupPage()">
					</div>
				</div>
				<div id="reasons_page_lip">
				</div>
			</div>
			<div id="reasons_container">
				<div id="reasons-content-border-top">
				</div>
				<div id="reasons-content-wrap">
					<div id="reasons-content-left">
						<h1>The Number 1 and Only Reliable Dating Site for Somali Singles</h1>
						<p>Among other dating sites that you can find all over the internet, Qalanjo is the only one that offers the most reliable methods in helping Somali individuals find their respective partners in life. Our site guarantees you a happy ever after result since the dating methods here are highly based in a scientific approach. Qalanjo’s ways of finding you your perfect match are proven to be very effective for the reason that they are tested from thousands of successful relationships.</p>
						<p>Once you entrust your lovelife to us, the members of the Qalanjo dating website team will absolutely help you find your way to the person rightfully meant for you. Every moment you spend with us in your search for true love will be worth it. Qalanjo’s compatibility and matching methods for all single men and women will definitely lead to a long term relationship and commitment.</p>
						<p>Unlike any other dating sites that you can choose to register, there is nothing like than the features that Qalanjo offer you. This dating site provides a filter-like system that will enable you to find just exactly the perfect person for you. Given the list of potential partners that match the qualities of your ideal partner in life, Qalanjo would break down this list further to an even more specific level until such time that it reaches the one and only person for you with whom you are bound to share a wonderful and meaningful relationship.</p>
						
						<h2>Find the Perfect Person for you in just 4 easy steps!</h2>
						<ul>
							<li>
								<div class="step step-1"></div>
								Sign up and register in our website, complete the relationship questionnaire and create your own personal profile absolutely free.
							</li>
							<li>
								<div class="step step-2"></div>
								Go over the questionnaires you have completed and carefully choose the qualities you prefer in finding your match.
							</li>
							<li>
								<div class="step step-3"></div>
								Choose the plan that you want once you are ready to start your search for love.
							</li>
							<li class="list-last">
								<div class="step step-4"></div>
								Communicate with your match prospects, and then you can start dating them!
							</li>
						</ul>
						<p class="clear space-top">It’s that simple!</p>
						
						<h2>Meet People of Your Own Kind</h2>
						<p>Since Qalanjo is an exclusive dating site for Somali people, you are assured to find the perfect person that can easily meet the standards you set in a lifetime partner. Given that the participants of this dating site are of the same religion, beliefs, and culture, finding you a love interest is made a lot easier and possible. However, even with these existing similarities, the crucial part is to find that specific person who meets the characteristics and traits you have indicated prior to proceeding exploring our site. With the help of the proven science that our compatibility and match tests are based on, Somali singles who signed up here at Qalanjo are now a step closer to finally be in union their better half. </p>
					
						<h2>Search for Somali Singles Online</h2>
						<p>This site is highly useful especially to Somali singles who are very busy in their respective careers and professions which made them have no more time for finding the love of their life that they rightfully deserve. Through Qalanjo, you are given the opportunity to find your perfect match without having to chill outdoors. No need to go out to coffee shops, bar and restaurants just to find yourself a date. You only have to sit down in front of your monitor, click on the mouse for a few times, and voila! You can now see the man or woman of your dreams. There is no chance for you on meeting people who aren’t even half of what you want your future partner to be. Your time and effort will certainly not be put to waste once you submit to Qalanjo the future of your love life. We give only the BEST to you.</p>
					</div>
				</div>
				<div id="reasons-content-border-bottom">
				</div>
				<div id="reasons-content-footer">
					<div class="footer_links">
						<strong>&copy; Qalanjo, Inc.</strong>
						<a href="#">Site Maps</a>
						<a href="#">How It Works</a>
						<a href="#">Media Center</a>
						<a href="#">Affiliates</a>
						<a href="#">Online Dating Safety Tips</a>
						<a href="#">Local</a>
						<a href="#">Help</a>
						<br />
						<a href="#">About Us</a>
						<a href="#">Why Qalanjo</a>
						<a href="#">Career</a>
						<a href="#">Privacy</a>
						<a href="#">Terms and Services</a>
						<a href="#">Feedback</a>
						<a href="#">Contact Us</a>
					</div>
				</div>
			</div>
		</div>
