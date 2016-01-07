<?php echo head(array('bodyid'=>'home')); ?>

<aside id="intro" role="introduction">
    <p><?php echo option('description'); ?></p>
</aside>

<?php /*if (get_theme_option('Homepage Text')): ?>
<p><?php echo get_theme_option('Homepage Text'); ?></p>
<?php endif; */?>

<!-- Featured Text -->
<div id="featured-item">
<h2>Édito</h2>
    <p><?php echo get_theme_option('Homepage Text'); ?></p>
</div><!--end featured-text-->

<?php /* if (get_theme_option('Display Featured Item') !== '0'): ?>
<!-- Featured Item -->
<div id="featured-item">
    <h2><?php echo __('Featured Item'); ?></h2>
    <?php echo random_featured_items(1); ?>
</div><!--end featured-item-->
<?php endif; */?>

<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>

<?php if (get_theme_option('Display Featured Collection') !== '0'): ?>
<!-- Featured Collection -->
<div id="featured-collection">
    <h2><?php echo __('Featured Collection'); ?></h2>
    <?php echo random_featured_collection(); ?>
</div><!-- end featured collection -->
<?php endif; ?>

<?php if ((get_theme_option('Display Featured Exhibit') !== '0')
        && plugin_is_active('ExhibitBuilder')
        && function_exists('custom_exhibit_builder_display_random_featured_exhibit')): ?>
<!-- Featured Exhibit in themes/season/custom.php -->
<?php echo custom_exhibit_builder_display_random_featured_exhibit(); ?>
<?php endif; ?>

<div id="recent-items">
  <h2>Parcourir les collections</h2>
  <?php echo custom_collectionTreeFullList() ?>
</div>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>
