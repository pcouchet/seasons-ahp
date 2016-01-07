</div><!-- end content -->

<footer>
  <div class="footer-text">
    <?php if ( $footerText = get_theme_option('Footer Text') ): ?>
    <p><?php echo $footerText; ?></p>
    <?php endif; ?>
    <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
    <p><?php echo $copyright; ?></p>
    <?php endif; ?>
  </div>
  <?php fire_plugin_hook('public_footer'); ?>
</footer>

<ul class="footer-logo">
<li><a href="http://poincare.univ-lorraine.fr"> <img src="<?php echo WEB_ROOT;?>/themes/seasons-ahp/images/logo-ahp-small.png" alt="Logo AHP" /> </a></li>
<li><a href="http://www.msh-lorraine.fr"> <img src="<?php echo WEB_ROOT;?>/themes/seasons-ahp/images/logo-msh-lorraine_110.jpg" alt="Logo MSH Lorraine" /> </a></li>
<li><a href="http://www.univ-lorraine.fr"> <img src="<?php echo WEB_ROOT;?>/themes/seasons-ahp/images/logo-udl-small.jpg" alt="Logo Université Lorraine" /> </a></li>
<li><a href="http://www.cnrs.fr"> <img src="<?php echo WEB_ROOT;?>/themes/seasons-ahp/images/logo-cnrs_80.png" alt="Logo CNRS" /> </a></li>
<li><a href="http://www.huma-num.fr"> <img src="<?php echo WEB_ROOT;?>/themes/seasons-ahp/images/logo-huma-num-75.png" alt="Logo Huma-Num" /> </a></li>
</ul>

</div><!--end wrap-->

<script type="text/javascript">
jQuery(document).ready(function () {
    Seasons.showAdvancedForm();
    Seasons.mobileSelectNav();
});
</script>

</body>

</html>
