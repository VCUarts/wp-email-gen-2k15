<?php
$image = get_sub_field( 'gallery_image' );
$caption = get_sub_field( 'gallery_caption' );
$link = get_sub_field( 'gallery_link' );

if ( $link ) : ?>
  <a href="<?php echo esc_url( $link ); ?>" target="_blank">
<?php endif;

  if ( $image ) : ?>
    <img class="img-border image_fix" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
  <?php endif;

  if ( $caption ) :
    echo '<div class="caption"><p>' . wp_kses_data( $caption ) . '</p></div>';
  endif;

if ( $link ) :
  echo '</a>';
endif;
