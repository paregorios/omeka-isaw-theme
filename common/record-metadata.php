<?php 

require 'vendor/autoload.php';

function startsWith($haystack, $needle)
{
    return $needle === "" || strpos($haystack, $needle) === 0;
}
function endsWith($haystack, $needle)
{
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}

?>

<?php if(isset(get_view()->item) or isset(get_view()->collection)): //check if this looks like an item or collection show page ?>

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

    <!-- creator for collections --> 
    <!-- TODO: handle multiple creators -->
    <?php if(isset(get_view()->collection) and isset($wantedElements['Creator'])): ?>
        <p class="element">
            <span class="element-name" title="creator">By: </span>:
            <?php $subject = $wantedElements['Creator']; 
            $textz = $subject['texts'][0]; ?>
            <span class="element-text" property="dcterms:creator">
                <?php if(startsWith($textz, "http://isaw.nyu.edu/people/") or startsWith($textz, "https://isaw.nyu.edu/people/")): 
                    $url=$textz . "/foaf.rdf";
                    $graph = EasyRdf_Graph::newAndLoad($url);
                    if ($graph->type() == 'foaf:PersonalProfileDocument') {
                        $person = $graph->primaryTopic();
                    } elseif ($graph->type() == 'foaf:Person') {
                        $person = $graph->resource();
                    }
                    ?>
                    <!-- ISAW person -->
                    <a text="link to ISAW personal profile" href="<?php echo $textz; ?>"><?php echo $person->get('foaf:name') ?></a>
                <?php else: ?>
                    <!-- plain-text creator -->
                    <?php foreach($subject['texts'] as $text): ?>
                        <?php foreach ($elementInfo['texts'] as $text): 
                             echo $text;
                        endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </span>
        </p>
        <?php unset($wantedElements['Creator']); ?>
    <?php endif;?>

    <!-- subject -->
    <?php if(isset($wantedElements['Subject'])):
        $subject = $wantedElements['Subject']; ?>
        <p class="hero element"><?php 
            foreach($subject['texts'] as $text):
                echo $text;
            endforeach; ?></p>
        <?php unset($wantedElements['Subject']); ?>
    <?php endif;?>

    <!-- description -->
    <?php if(isset($wantedElements['Description'])):
        $subject = $wantedElements['Description'];
            foreach($subject['texts'] as $text): ?>
            <p class="element"><?php echo $text; ?></p>
            <?php endforeach; ?>
        <?php unset($wantedElements['Description']); ?>
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