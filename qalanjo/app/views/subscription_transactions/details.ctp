<?php 
	$path = "/css/img/blue/subscribe/";
	$this->Html->css("blue/subscription", "stylesheet", array("inline"=>false));
	$this->Javascript->link(array("blue/subscription_transactions/details"), false);
?>
<div class="settings-container left">
    <div class="subscribe-banner left">
    	<?php echo $this->Html->image($path."encourage.png", array("class"=>"left", "alt"=>"Subscribe Now"))?>
    </div>
    <div class="encourage-line left">
        <div class="encourage-line-message left">
            <strong class="left"><?php echo $member["Member"]["firstname"]." ".$member["Member"]["lastname"]?></strong>
            <span class="left clear">Experience the Qalanjo
                difference.</span>
        </div>
        <div class="arrow left">
        </div>
        <div class="arrow-yellow left">
        </div>
        <div class="feature-message right">
            <h2>Premium Personality Profile and other Basic Plus features.</h2>
        </div>
    </div>
    <div class="clear left spacer-line">
    </div>
    <div id="frames" class="left frames">
        <div id="viewport" class="viewport left">
            <div class="left subscription-item">
                <h3 class="months">12 months</h3>
                <h2 class="subscription-description most-successful">Most Successful</h2>
                <h2 class="price">$ 22.99</h2>
                <h3 class="permonth">per month</h3>
                <div class="join">
                    <a id="item_1" href="#"></a>
                </div>
            </div>
            <div class="item-spacer left">
            </div>
            <div class="left subscription-item">
                <h3 class="months">6 months</h3>
                <h2 class="subscription-description top-seller">Top Seller</h2>
                <h2 class="price">$ 32.99</h2>
                <h3 class="permonth">per month</h3>
                <div class="join">
                    <a id="item_2" href="#"></a>
                </div>
            </div>
            <div class="item-spacer left">
            </div>
            <div class="left subscription-item">
                <h3 class="months">3 months</h3>
                <h2 class="subscription-description other">Basic Plan</h2>
                <h2 class="price">$ 42.99</h2>
                <h3 class="permonth">per month</h3>
                <div class="join">
                    <a id="item_3" href="#"></a>
                </div>
            </div>
            <div class="item-spacer left">
            </div>
            <div class="left subscription-item">
                <h3 class="months">1 months</h3>
                <h2 class="subscription-description other">1 Month Plan</h2>
                <h2 class="price">$ 49.99</h2>
                <h3 class="permonth">per month</h3>
                <div class="join">
                    <a id="item_4" href="#"></a>
                </div>
            </div>
            <div class="control-pay left">
                <div class="select-method left">
                    <p>
                        Select your mode of payment
                    </p>
                </div>
                <div class="arrow-back left" id="arrow-back">
                </div>
                <div class="paypal-pay left">
                </div>
                <div class="cc-pay left">
                </div>
            </div>
        </div>
    </div>
    <div class="reasons left">
        <div class="benefits left">
            <h2 class="left"><span class="membership-plan-header left">Membership
                    Plan Features</span><span class="premium-header left">Premium</span><span class="free-header left">Free</span></h2>
            <ul class="benefit-list left">
                <li>
                    <div class="col1 left">
                        Receive daily personalized match
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                    </div>
                </li>
                <li>
                    <div class="col1 left">
                        Receive daily updates directly to your email
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                    </div>
                </li>
                <li>
                    <div class="col1 left">
                        Wink to express your interest
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                        <div class="checkgray check left">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col1 left">
                        Send free ice breakers.
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                        <div class="checkgray check left">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col1 left">
                        Organize your contacts using the Matches page
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                    </div>
                </li>
                <li>
                    <div class="col1 left">
                        See who viewed your profile
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                        <div class="checkgray check left">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="col1 left">
                        Find your matches using our custom Single Finder
                        System
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                    </div>
                </li>
                <li>
                    <div class="col1 left">
                        Build your personal profile page
                    </div>
                    <div class="col2 left">
                        <div class="checkblue check left">
                        </div>
                    </div>
                    <div class="col2 left">
                        <div class="checkgray check left">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="why-qalanjo left">
            <h2>Why Qalanjo?</h2>
            <p class="works">
                It works!
            </p>
            <p class="works-reason">
                Qalanjo.com gives you a chance to meet with
                strangers who will eventually play a very important role in your life.
            </p>
            <p class="payment">
                <strong>We accept payment</strong>
            </p>
            <p>
            	<?php echo $this->Html->image($path."cc_cards_s1.png", array("alt"=>"visa amex paypal master"))?>
            </p>
            <p class="read-more">
                <a href="#">Read more about Qalanjo</a>
            </p>
        </div>
    </div>
</div>
