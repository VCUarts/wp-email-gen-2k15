<div class="gallery-wrap content"> 
  <table cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
      <td>

        <?php
        $itemCount = 0;
        $columns = get_sub_field( 'columns' );

        if ( have_rows( 'gallery_item' ) ) :

          while ( have_rows( 'gallery_item' ) ) :  the_row();
        $itemCount++;

        if ( $columns == 3 ) :

          if ( $itemCount % 3 == 0 ) :  ?>
        <td class="column column-last" width="180" valign="top">
          <?php get_template_part( 'library/flexible-content/gallery', 'item' );
          $itemCount = 0; ?>
          <?php
          elseif ( $itemCount % 2 == 1 ) :  ?>
          <td class="column column-first" width="180" valign="top">
            <?php get_template_part( 'library/flexible-content/gallery', 'item' ); ?>
            <?php
            else : ?>
            <td class="column column-mid" width="180" valign="top">
              <?php get_template_part( 'library/flexible-content/gallery', 'item' ); ?>
              <?php
              endif; ?>
            </td>

            <?php
            elseif ( $columns == 2 ) :

              if ( $itemCount % 2 == 1 ) :  ?>
            <td class="column column-one" width="230" valign="top">
              <?php get_template_part( 'library/flexible-content/gallery', 'item' ); ?>
              <?php
              else : ?>
              <td class="column column-two" width="230" valign="top">
                <?php get_template_part( 'library/flexible-content/gallery', 'item' ); ?>
                <?php
                endif; ?>
              </td>
              
              <?php
              else : ?>
              <td class="column full-width">
                <?php get_template_part( 'library/flexible-content/gallery', 'item' ); ?>
              </td>


              <?php
              endif;

              endwhile;
              endif; ?>
            </td>
          </tr>
        </table>
      </div>
