<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
if ($collectionTitle == '') {
    $collectionTitle = __('[Untitled]');
}
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo all_element_texts('collection'); ?>

<div class="item hentry">
  <?php
  //echo '<h2>'.$collectionTitle.'</h2>';
  echo '<div>';
  if (metadata('collection', 'total_items') > 0){
    echo '<a href="'.WEB_ROOT.'/items/browse?collection='.metadata('collection', 'id').'">';
    echo 'Contenus de la collection</a> ';
    echo '('.metadata('collection', 'total_items').')';
  }
  else echo 'Cette collection n\'a pas de contenu. Veuillez parcourir les sous-collections';
  echo '</div>'."\n";
  ?>

<?php if (metadata('collection', 'total_items') > 0): ?>
  <div><span style="margin-top:0.5em;font-weight:bold;">Vue rapide</span> :</div>
    <ul style="margin:0 1em;">
    <?php foreach (loop('items') as $item): ?>
      <li>
        <?php echo $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>;
        <?php if ($creator = metadata('item', array('Dublin Core', 'Creator'), array('snippet'=>250))): ?>
          <?php echo $creator; ?>;
        <?php endif; ?>
        <?php if ($date = metadata('item', array('Dublin Core', 'Date'), array('snippet'=>250))): ?>
          <?php echo $date; ?>;
        <?php endif; ?>
        <?php echo link_to_item('Détail', array('class'=>'permalink')); ?>
      </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>

<?php echo foot(); ?>
