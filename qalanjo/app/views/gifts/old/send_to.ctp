<?php echo $session->flash();?>

<div id="updatable_div">
      <div id="contentarea">
        <!--center content here-->
        <p>Send Gift</p>
        <p>Choose a partner to send a gift to</p>
      	<div id="mainContent">
      		<?php echo $this->element('gifts/list_connection',array('connections'=>$connections));?>
      	</div>
      </div>
</div>