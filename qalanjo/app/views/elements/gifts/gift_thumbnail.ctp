<?php echo $html->image('gifts/category/' . strtolower($typeName) . '/thumbnails/' . $gift['Gift']['picture_path']); ?>
<div class="name"><?php echo $gift['Gift']['name'] ?></div>
<div class="price">Price: <?php echo $gift['Gift']['price']?> QPoints</div>