<?php
$pageTitle = __('Browse Items by Tag');
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>

<div>
<h2><?php echo $pageTitle; ?></h2>
<p>
<?php echo __('Sort by: '); ?>

<a class="current" href="./tags?sort_field=name&sort_dir=a"><?php echo __('Alphabetical'); ?></a> |
<a href="./tags?sort_field=count&sort_dir=d"><?php echo __('Most'); ?></a> |
<a href="./tags?sort_field=count&sort_dir=a"><?php echo __('Least'); ?></a> |
<a href="./tags?sort_field=time&sort_dir=d"><?php echo __('Recent'); ?></a> |
</p>
<?php
echo tag_cloud($tags, 'items/browse', $maxClasses = 9, $tagNumber = true, $tagNumberOrder = 'after'); ?>
</div>

<?php echo foot(); ?>
