<?php

$image = get_sub_field( 'hero_image' );
$caption = get_sub_field( 'hero_caption' );
$link = get_sub_field( 'hero_link' ); ?>
<div class="hero-wrap content"> 
  <table cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
      <td>
        <div class="gallery">
          <table cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
              <td class="column full-width">
                <?php if ( $link ) { ?><a href="<?php echo $link; ?>" target="_blank"><?php }?>
                <img class="image_fix" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                <?php if ( $link ) { ?></a><?php }?>

                <?php if ( $caption ) :  ?> 
                <div class="img-caption"><?php echo $caption; ?></div>
              <?php endif; ?>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
</div>
