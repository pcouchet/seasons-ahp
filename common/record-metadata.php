<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
        <span style="font-weight:bold;"><?php echo html_escape(__($elementName)); ?></span> :
        <?php foreach ($elementInfo['texts'] as $text): ?>
            <?php
            if($elementName=='URL') echo '<span class="element-text"><a href="'.$text.'" target="_blank">'.$text.'</a></span>';
            else echo '<span class="element-text">'.$text.'</span>';
            ?>
        <?php endforeach; ?>
    </div><!-- end element -->
    <?php endforeach; ?>
</div><!-- end element-set -->
<?php endforeach;
