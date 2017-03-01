<div class="content"> 
  <table cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
      <td>
        <?php
          if ( get_sub_field( 'column_select' ) == 2 ) :  ?>
            <table cellpadding="0" cellspacing="0" border="0" align="center">
              <tr>
                <td class="column column-one" width="265" valign="top">
                  <?php the_sub_field( 'wsiwyg_1' ); ?>
                </td>
                <td class="column column-two" width="265" valign="top">
                  <?php the_sub_field( 'wsiwyg_2' ); ?>
                </td>
              </tr>
            </table>
          <?php else : ?>
            <?php the_sub_field( 'wsiwyg_1' ); ?>
          <?php endif;
        ?>
      </td>
    </tr>
  </table>
</div>
