<?php echo head(array('title' => __('Collection Tree'))); ?>
<div id="collection-tree">
<h2>Collections</h2>
<?php if ($this->full_collection_tree): ?>
<?php echo custom_collectionTreeFullList() ?>
<?php //echo $this->full_collection_tree; ?>
<?php else: ?>
<p><?php echo __('There are no collections.'); ?></p>
<?php endif; ?>
</div>
<?php echo foot(); ?>