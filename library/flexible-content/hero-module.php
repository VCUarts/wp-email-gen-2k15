<?php
$image = get_sub_field( 'hero_image' );
$caption = get_sub_field( 'hero_caption' );
$link = get_sub_field( 'hero_link' ); ?>

<div class="hero-wrap content"> 
  <table cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
      <td width="500">
          <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
              <td class="full-width">
                <?php if ( $link ) { ?><a href="<?php echo esc_url( $link ); ?>" target="_blank"><?php }?>
                  <img class="image_fix" src="<?php echo esc_url( $image['url'] ); ?>"/>
                <?php if ( $link ) { ?></a><?php }?>

                <?php if ( $caption ) :  ?> 
                  <div class="img-caption"><?php echo wp_kses_data( $caption ); ?></div>
                <?php endif; ?>
              </td>
            </tr>
          </table>
      </td>
    </tr>
  </table>
</div>
