<?php if (is_single()): ?>
   <table cellpadding="0" cellspacing="0" border="0" align="center" class="footer-wrap">
     <tr>
       <td class="container">
         <div class="footer content">
           <table>
             <tr>
               <td>

                 <a href="http://arts.vcu.edu/admissions/how-to-apply/" title="Apply Now" class="apply-now">APPLY NOW</a>

                 <div class="social">
                   <table cellpadding="0" cellspacing="0" border="0" align="center" class="social-table">
                     <tr>
                       <td width="20%">
                         <a href="https://www.facebook.com/vcuarts" target="_blank"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/library/images/social/facebook.png" width="13" height="25"></a>
                       </td>
                       <td width="20%">
                         <a href="https://twitter.com/vcuarts" target="_blank"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/library/images/social/twitter.png" width="29" height="24"></a>
                       </td>
                       <td width="20%">
                         <a href="http://instagram.com/vcuarts" target="_blank"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/library/images/social/instagram.png" width="25" height="25"></a>
                       </td>
                       <td width="20%">
                         <a href="http://www.youtube.com/vcuarts" target="_blank"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/library/images/social/youtube.png" width="25" height="25"></a>
                       </td>
                       <td width="20%">
                         <a href="mailto:arts@vcu.edu" target="_blank"><img class="image_fix" src="<?php echo get_template_directory_uri(); ?>/library/images/social/email.png" width="26" height="25"></a>
                       </td>
                     </tr>
                   </table>
                 </div>

                 <p>
                  Virginia Commonwealth University | School of the Arts <br>
                  325 North Harrison Street, PO Box 842519 | Richmond, VA 23284-2519 <br>
                  Phone: 804-VCU-ARTS (804-828-2787) | 866-534-3201 (toll free) | Fax: 804-828-6469 <br>
                  <a href="<?php the_permalink(); ?>">View in Browser</a>
                </p>

                <table cellpadding="0" cellspacing="0" border="0" align="center" class="vcu-footer">
                  <tr>
                    <td>
                      <p>
                        <a href="http://www.vcu.edu/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/vcu-seal.png" width="103" height="30"></a>
                      </p>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
          </table>
        </div>
      </td>
      <td></td>
    </tr>
  </table>
<?php wp_footer(); ?>
  </td>
</tr>
</table>
<?php endif; ?>
</body>

</html>