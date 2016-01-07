<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1 style="font-size: 24px;font-weight:400;color: #fff;"><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>
<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date du document')] = 'Dublin Core,Date';
//$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links" style="float:right">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>
<?php endif; ?>


<?php foreach (loop('items') as $item): ?>
<div class="item hentry">
    <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>
    <div class="item-meta">
    <?php if (metadata('item', 'has thumbnail')): ?>
    <div class="item-img">
        <?php echo link_to_item(item_image('square_thumbnail')); ?>
    </div>
    <?php endif; ?>

    <div class="item-description">
    <?php if ($creator = metadata('item', array('Dublin Core', 'Creator'), array('snippet'=>250))): ?>
        <?php echo $creator; ?>;
    <?php endif; ?>
    <?php if ($date = metadata('item', array('Dublin Core', 'Date'), array('snippet'=>250))): ?>
        <?php echo $date; ?>
    <?php endif; ?>
    </div>

    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
    <div class="item-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <?php if (metadata('item', 'has tags')): ?>
    <div class="tags">
      <p><?php echo __('Tags'); ?> : <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>

    <?php
    $collection = link_to_collection_for_item();
    if (!empty($collection)): ?>
    <div class="collection">
    	Collection :
        <?php echo $collection; ?>
    </div>
    <?php endif; ?>

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
