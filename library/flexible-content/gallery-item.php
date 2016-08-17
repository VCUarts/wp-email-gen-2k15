<?php
$image = get_sub_field('gallery_image');
$caption = get_sub_field('gallery_caption');
$link = get_sub_field('gallery_link');
?>

<?php if ($link): ?>
  <a href="<?php echo $link; ?>" target="_blank">
<?php endif; ?>

  <?php if ($image): ?>
    <img class="image_fix" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
  <?php endif; ?>

  <?php if ($caption): ?>
    <div class="caption">
      <?php echo $caption; ?>
    </div>
  <?php endif; ?>

<?php if ($link): ?>
  </a>
<?php endif; ?>