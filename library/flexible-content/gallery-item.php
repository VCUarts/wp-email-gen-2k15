<?php
$image = get_sub_field('gallery_image');
$caption = get_sub_field('gallery_caption');
$link = get_sub_field('gallery_link');
?>

<?php if ($link): ?>
  <a href="<?php echo $link; ?>" target="_blank">
<?php endif; ?>

  <?php if ($image): ?>
    <img src="<?php echo $image['url']; ?>" alt="">
  <?php endif; ?>

  <?php echo $caption; ?>

<?php if ($link): ?>
  </a>
<?php endif; ?>