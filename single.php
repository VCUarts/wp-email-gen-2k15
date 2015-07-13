<?php get_header(); ?>

<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
<tr>
  <td>

    <!-- HEADER -->
    <table cellpadding="0" cellspacing="0" border="0" align="center" class="head-wrap">
      <tr>
        <td></td>
        <td class="header container">

            <div class="content header-logo">
            <table>
              <tr>
                <td><a href="http://arts.vcu.edu/about/national-rankings/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/vcuarts-header.png" /></a></td>
              </tr>
            </table>
            </div>

        </td>
        <td></td>
      </tr>
    </table><!-- /HEADER -->

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
              $email_title = get_field('email_title');
               ?>

               <?php if ($email_title): ?>
                 <h1 class="email-title"><?php echo $email_title; ?></h1>
               <?php endif; ?>

              <?php 
              // check if the flexible content field has rows of data
              if( have_rows('email_content') ):

                // loop through the rows of data
                while ( have_rows('email_content') ) : the_row();

                  // check current row layout
                  if( get_row_layout() == 'hero_image_module' ):
                    get_template_part( 'library/flexible-content/hero', 'module' );
                  elseif( get_row_layout() == 'wsiwyg_module' ):
                    get_template_part( 'library/flexible-content/wsiwyg', 'module' );
                  elseif( get_row_layout() == 'gallery' ):
                    get_template_part( 'library/flexible-content/gallery', 'module' );
                  endif;


                endwhile;   

              endif;

               ?>

               <div class="social" style="background-image:url(<?php echo get_template_directory_uri(); ?>/library/images/rule.png);">
                 <a href="https://www.facebook.com/vcuarts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/facebook.png"></a>
                 <a href="https://twitter.com/vcuarts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/twitter.png"></a>
                 <a href="http://instagram.com/vcuarts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/instagram.png"></a>
                 <a href="http://www.youtube.com/vcuarts" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/youtube.png"></a>
                 <a href="mailto:arts@vcu.edu" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/email.png"></a>
               </div>

               <?php 

               $chunks = get_field('chunks');
               $chunkCount = 0;

               if( $chunks ): ?>
               <div class="chunks">
               <table cellpadding="0" cellspacing="0" border="0" align="center">
                 <tr>
                  <?php foreach( $chunks as $post): // variable must be called $post (IMPORTANT) ?>
                    <?php setup_postdata($post);
                      $image = get_field('chunk_image'); 
                      $chunk_title = get_field('chunk_headline');
                      $chunk_content = get_field('chunk_content'); 
                      $chunk_link = get_field('more_link'); ?>

                    <?php if ($chunkCount++ % 2 == 1 ): ?>
                      <td class="column column-two" width="265" valign="top">
                    <?php else: ?>
                      <td class="column column-one" width="265" valign="top">
                    <?php endif; ?>
                       <?php if ($image):?><img src="<?php echo $image['url'];?>"><?php endif; ?>
                       <?php if ($chunk_title):?><h2 class="chunk-title"><?php echo $chunk_title; ?></h2><?php endif; ?>
                       <?php if ($chunk_content): echo $chunk_content; endif; ?>
                       <?php if ($chunk_link): ?><a href="<?php echo $chunk_link; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/more-btn.png" /></a> <?php endif; ?>
                      </td>
                  <?php endforeach; ?>
                  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                 </tr>
               </table>
               </div>
               <?php endif; ?>

               <div class="how-to-apply">
                 <a href="http://arts.vcu.edu/admissions/how-to-apply/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/howtoapply.png"></a>
               </div>

               <div class="link-bar">
                 <a href="http://arts.vcu.edu/about/national-rankings/" target="_blank">RANKINGS</a> //
                 <a href="http://arts.vcu.edu/programs/undergraduate-programs/" target="_blank">MAJORS</a> //
                 <a href="http://arts.vcu.edu/admissions/visit-campus/" target="_blank">VISIT CAMPUS</a> //
                 <a href="http://arts.vcu.edu/admissions/publications/" target="_blank">PUBLICATIONS</a>
               </div>

               </td>
             </tr>
           </table>
           </div>

         </td>
       </tr>
     </table><!-- /BODY -->

   </td>
 </tr>
 </table>
  
<?php get_footer(); ?>
