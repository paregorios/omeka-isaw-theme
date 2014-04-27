<?php if(isset(get_view()->item)): //check if this looks like an item show page ?>

<?php
//dig through the elements for display that are passed into this file
//put it all into a new array of just the elements we want
//this should let you collect the elements you want in the order you want
//follow this pattern to get more or change the order

$wantedElements = array();
if(isset($elementsForDisplay['Item Type Metadata'])) {
    foreach ($elementsForDisplay['Item Type Metadata'] as $elementName => $elementInfo):
            $wantedElements[$elementName] = $elementsForDisplay['Item Type Metadata'][$elementName];
    endforeach;
}
if(isset($elementsForDisplay['Dublin Core'])) {
    foreach ($elementsForDisplay['Dublin Core'] as $elementName => $elementInfo):
            $wantedElements[$elementName] = $elementsForDisplay['Dublin Core'][$elementName];
    endforeach;
}
unset($wantedElements['Title']);
?>

<div class="element-set">
    <?php if($subject = $wantedElements['Dublin Core']['Subject']): ?>
        <p class="hero"><?php echo $subject; ?></p>
    <?php endif;?>
    <?php foreach ($wantedElements as $elementName => $elementInfo): ?>
    <p id="<?php echo text_to_id(html_escape("$elementName")); ?>" class="element">
        <span class="element-name"><?php echo html_escape(__($elementName)); ?></span>:
        <?php foreach ($elementInfo['texts'] as $text): ?>
        <span class="element-text"><?php echo $text; ?></span>
        <?php endforeach; ?>
    </p><!-- end element -->
    <?php endforeach; ?>
</div><!-- end element-set -->

<?php else: ?>

<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <h2><?php echo html_escape(__($setName)); ?></h2>
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
        <h3><?php echo html_escape(__($elementName)); ?></h3>
        <?php foreach ($elementInfo['texts'] as $text): ?>
            <div class="element-text"><?php echo $text; ?></div>
        <?php endforeach; ?>
    </div><!-- end element -->
    <?php endforeach; ?>
</div><!-- end element-set -->
<?php endforeach; ?>

<?php endif; ?>