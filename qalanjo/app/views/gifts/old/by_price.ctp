<?php echo $session->flash();?>

<div id="updatable_div">
      <div id="contentarea">
        <!--center content here-->
        <p>Gifts with Price Range: <?php echo $price_range;?></p>
      	<div id="mainContent">
      		<?php echo $this->element('gifts/paginated_gifts',array('gifts'=>$gifts));?>
      	</div>
      </div>
</div>