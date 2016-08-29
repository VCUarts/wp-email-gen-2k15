<?php get_header(); ?>

<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
  <tr>
    <td>

    <!-- HEADER -->
      <table cellpadding="0" cellspacing="0" border="0" align="center" class="head-wrap">
       <!-- row -->
        <tr>

          <td>
          </td>

          <td class="header container">

            <div class="header-logo">
              <table>
                <tr>
                  <td>
                    <a href="http://arts.vcu.edu/" target="_blank">
                      <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/library/images/branding/vcuarts_header.png" />
                    </a>
                  </td>
                </tr>
              </table>
            </div>

          </td>

          <td>
          </td>

        </tr>
       <!-- end of row -->
      </table>
      <!-- /HEADER -->

    <!-- BODY -->
    <table cellpadding="0" cellspacing="0" border="0" align="center" class="body-wrap">
      <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

          <div class="content">
            <table cellpadding="0" cellspacing="0" border="0" align="center">
              <tr>
                <td>

                <?php
                $email_title = get_field( 'email_title' );
                if ( $email_title ) : ?>

                   <center><h1 class="email-title"><?php echo esc_html( $email_title ); ?></h1></center>

                 <?php endif; ?>

                 </td>
               </tr>
             </table>
           </div> <!-- closing content before hero -->

              <?php
              // check if the flexible content field has rows of data
              if ( have_rows( 'email_content' ) ) :

                // loop through the rows of data
                while ( have_rows( 'email_content' ) ) : the_row();

                  // check current row layout
                  if ( get_row_layout() == 'hero_image_module' ) :
                    get_template_part( 'library/flexible-content/hero', 'module' );

                    elseif ( get_row_layout() == 'wsiwyg_module' ) :
                      get_template_part( 'library/flexible-content/wsiwyg', 'module' );
                    elseif ( get_row_layout() == 'gallery' ) :
                      get_template_part( 'library/flexible-content/gallery', 'module' );
                  endif;
                endwhile;

              endif;


               $chunks = get_field( 'chunks' );
               $chunk_count = 0;

               if ( $chunks ) : ?>

               <div class="content">
               <table cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                  <td>


               <div class="chunks">
               <table cellpadding="0" cellspacing="0" border="0" align="center">
                 <tr>
                  <?php foreach ( $chunks as $post ) : // variable must be called $post (IMPORTANT)
                    setup_postdata( $post );
                      $image = get_field( 'chunk_image' );
                      $chunk_title = get_field( 'chunk_headline' );
                      $chunk_content = get_field( 'chunk_content' );
                      $chunk_link = get_field( 'more_link' ); ?>

                    <?php if ( 1 == $chunk_count++ % 2 ) : ?>
                      <td class="column column-two" width="230" valign="top">
                    <?php else : ?>
                      <td class="column column-one" width="230" valign="top">
                    <?php endif; ?>
                       <?php if ( $image ) :?><img class="chunk-img" src="<?php echo esc_url( $image['url'] ); ?>"><?php endif; ?>
                       <?php if ( $chunk_title ) :?>
                         <h5 class="chunk-title"><?php echo esc_html( $chunk_title ); ?></h5>
                       <?php endif; ?>
                       <?php if ( $chunk_content ) :
                         the_field( 'chunk_content' );
                       endif; ?>
                       <?php if ( $chunk_link ) : ?><a href="<?php echo esc_url( $chunk_link ); ?>" target="_blank"><img class="more-btn" src="<?php echo esc_url( get_template_directory_uri() ); ?>/library/images/more-btn.png" /></a> <?php endif; ?>
                      </td>
                  <?php endforeach; ?>
                  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                 </tr>
               </table>
               </div>

               </td>
                </tr>
             </table>
             </div>

             <?php endif; ?>

         </td>
       </tr>
     </table><!-- /BODY -->

   </td>
 </tr>
 </table>

<?php get_footer();
