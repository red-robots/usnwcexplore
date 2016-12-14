</div><!--end section-page-content-->
<div id="footer">

    
<div class="wrap">


<!--<div id="site-description"><?php bloginfo( 'description' ); ?></div>-->
<div class="copyright">U.S. National Whitewater Center | Copyright &copy; <?php echo date('Y'); ?> | All Rights Reserved | USNWC is a Non-Profit Organization<br />
5000 Whitewater Center Parkway | Charlotte, NC 28214 | 704.391.3900 | info@usnwc.org</div>




</div><!-- wrap -->
    
    
</div><!-- #footer -->

</div><!--end of section-page-container-->


<script type="text/javascript">

jQuery(document).ready(function($){

$(".showcredit").hover(function() {
      $(this).next(".photocredit").show();
}).mouseout(function() {
      $(this).next(".photocredit").hide();
});

});
</script>

<script type="text/javascript" language="JavaScript"><!--
jQuery(document).ready(function($) {
    $('#showmenu').click(function() {
            $('.nav').slideToggle("fast");
    });
});
</script>



<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15710269-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>






<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js?v=20120423234912"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js?v=20120423234909"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/mobilemenu.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/centerlogo.js"></script>

</body>
</html>