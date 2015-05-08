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

               </td>
             </tr>
           </table>
           </div>

         </td>
       </tr>
     </table>

   </td>
 </tr>
 </table>
  
<?php get_footer(); ?>
