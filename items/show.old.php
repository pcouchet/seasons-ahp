<?php
//<!-- LiquidSlider scripts with items/show -->
queue_css_url(WEB_ROOT.'/themes/seasons-ahp/liquidslider/css/liquid-slider.css');
queue_js_url(WEB_ROOT.'/themes/seasons-ahp/javascripts/jquery/1.9.1/jquery.min.js');
queue_js_url(WEB_ROOT.'/themes/seasons-ahp/liquidslider/js/jquery.easing.1.3.js');
queue_js_url(WEB_ROOT.'/themes/seasons-ahp/liquidslider/js/jquery.touchSwipe.min.js');
queue_js_url(WEB_ROOT.'/themes/seasons-ahp/liquidslider/js/jquery.liquid-slider.min.js');
$js = "
		$(function(){
      /* Here is the slider using default settings */
      $('#slider-id').liquidSlider();
      /* If you want to adjust the settings, you set an option
         as follows:
          $('#slider-id').liquidSlider({
            autoSlide:false,
            autoHeight:false
          });

         Find more options at http://liquidslider.kevinbatdorf.com/
      */
      /* If you need to access the internal property or methods, use this:
      var sliderObject = $.data( $('#slider-id')[0], 'liquidSlider');
      console.log(sliderObject);
      */
    });
";
queue_js_string($js);

echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>

<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
<!-- Liquid Slider Begins Here-->
    <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')){
			$attrs = array('wrapper' => array('id'=>'slider-id', 'class' => 'liquid-slider'),);
			echo custom_item_image_gallery($attrs);
			}
			?>
<!-- Liquid Slider Ends Here -->

<div id="primary">

    <?php echo all_element_texts('item'); ?>

<div>
<?php if (!$item) $item = get_current_record('item');
$files = $item->Files;
foreach($files as $file)
if ($file->getExtension() =='pdf'){echo '<iframe width=100% height=800 src="http://deevy.nuim.ie/pdf.js/web/viewer.html?file=http://deevy.nuim.ie/files/original/'.metadata($file,'filename').'"></iframe>';
break;
}
if($file->getExtension() !='pdf'){
fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item));
}
?>
</div>
</div><!-- end primary -->

<aside id="sidebar">

    <!-- The following returns all of the files associated with an item. -->
    <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php echo item_image_gallery(); ?>
    </div>
    <?php endif; ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="element">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Tags'); ?></h2>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

</aside>

<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<?php echo foot(); ?>

