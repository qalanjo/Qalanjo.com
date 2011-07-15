<?php 
	$path = "/css/img/blue/subscribe/";
	$this->Html->css("blue/qpoints_buy", "stylesheet", array("inline"=>false));
	$this->Javascript->link(array("blue/qpoints/details"), false);
?>
<div class="settings-container left">
    <?php 
    	if ($role==2){
    ?>
    <div class="subscribe-banner left">
    		<?php echo $this->Html->image($path."encourage.png", array("class"=>"left", "alt"=>"Subscribe Now"))?>
    </div>
    <?php 
    	}
    ?>
    <div class="encourage-line left">
        <div class="encourage-line-message left">
            <strong class="left"><?php echo $member["Member"]["firstname"]." ".$member["Member"]["lastname"]?></strong>
            <span class="left clear">Choose your package.</span>
        </div>
        <div class="arrow left">
        </div>
        <div class="arrow-yellow left">
        </div>
        <div class="feature-message right">
            <h2>You only have <span class="count"><?php echo $member["Member"]["credit_points"]?></span> <span class="q">Q</span>points.</h2>
        </div>
    </div>
    <div class="clear left spacer-line">
    </div>
    <div id="frames" class="left frames">
        <div id="viewport" class="viewport left">
            <div class="left qpoints-item">
            	<div class="shadow left"></div>
            	<div class="qpoints-item-content left">
            		<div class="coins gold"></div>
	            	<h3 class="gold">2500 Qpoints</h3>
	            	<h3 class="price">$ 39.99</h3>
	                <div class="join">
	                    <a id="item_1" href="#"></a>
	                </div>
            	</div>
                <div class="shadow left"></div>
            </div>
            <div class="item-spacer left">
            </div>
            <div class="left qpoints-item">
            	<div class="shadow left"></div>
            	<div class="qpoints-item-content left">
            		<div class="coins silver"></div>
	            	<h3 class="silver">1000 Qpoints</h3>
	            	<h3 class="price">$ 19.99</h3>
	                <div class="join">
	                    <a id="item_1" href="#"></a>
	                </div>
            	</div>
                <div class="shadow left"></div>
            </div>
            <div class="item-spacer left">
            </div>
             <div class="left qpoints-item">
            	<div class="shadow left"></div>
            	<div class="qpoints-item-content left">
            		<div class="coins bronze"></div>
	            	<h3 class="bronze">500 Qpoints</h3>
	            	<h3 class="price">$ 12.99</h3>
	                <div class="join">
	                    <a id="item_1" href="#"></a>
	                </div>
            	</div>
                <div class="shadow left"></div>
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
</div>