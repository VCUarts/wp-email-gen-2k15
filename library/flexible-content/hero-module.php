<?php 

$image = get_sub_field('hero_image');
$caption = get_sub_field('hero_caption'); ?>

<img class="image_fix" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" />

<?php if ($caption): ?> 
  <div class="img-caption"><?php echo $caption; ?></div>
<?php endif; ?>