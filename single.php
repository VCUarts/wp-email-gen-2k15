<?php get_header(); ?>

<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
<tr>
  <td>

    <!-- BROWSER VIEW LINK -->
    <table cellpadding="0" cellspacing="0" border="0" align="center" class="head-wrap">
      <tr>
        <td></td>
        <td class="container">

            <div class="content browser-view">
            <table>
              <tr>
                <td><a href="<?php the_permalink(); ?>">[browser view]</a></td>
              </tr>
            </table>
            </div>

        </td>
        <td></td>
      </tr>
    </table><!-- /BROWSER VIEW LINK  -->

    <!-- HEADER -->
    <table cellpadding="0" cellspacing="0" border="0" align="center" class="head-wrap">
      <tr>
        <td></td>
        <td class="header container">

            <div class="content header-logo">
            <table>
              <tr>
                <td><img src="<?php echo get_template_directory_uri(); ?>/library/images/vcuarts-header.png" /></td>
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
