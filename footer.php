<?php if (is_single()): ?>
  <div class="footer">
   <table cellpadding="0" cellspacing="0" border="0" align="center" class="head-wrap">
     <tr>
       <td></td>
       <td class="footer container">

           <div class="content">
           <table>
             <tr>
               <td>

                <div class="link-bar">
                 <p><a href="http://arts.vcu.edu/about/national-rankings/" target="_blank">Rankings</a> &nbsp;&nbsp;
                 <a href="http://arts.vcu.edu/programs/undergraduate-programs/" target="_blank">Majors</a> &nbsp;&nbsp;
                 <a href="http://arts.vcu.edu/admissions/visit-campus/" target="_blank">Visit Campus</a> &nbsp;&nbsp;
                 <a href="http://arts.vcu.edu/admissions/publications/" target="_blank">Publications</a></p>
               </div>

                 <p>
                   Virginia Commonwealth University | School of the Arts <br>
                   325 North Harrison Street, PO Box 842519 | Richmond, VA 23284-2519 <br>
                   Phone: 804-VCU-ARTS (804-828-2787) | 866-534-3201 (toll free) | Fax: 804-828-6469 <br>
                   <a href="mailto:arts@vcu.edu" target="_blank">arts@vcu.edu</a> &nbsp; | &nbsp;
                   <a href="<?php the_permalink(); ?>">View in Browser</a>
                 </p>
                 <p>
                   <a href="http://www.vcu.edu/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/vcu-logo.png"></a>
                 </p>
               </td>
             </tr>
           </table>
           </div>

       </td>
       <td></td>
     </tr>
   </table>
  </div>
<?php endif; ?>

  <?php // all js scripts are loaded in library/bones.php ?>
	<?php wp_footer(); ?>

  <?php echo get_development_scripts(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
