<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<div id="primary">
    <!-- Recent Items -->
    <div id="recent-items">
        <h2><?php echo __('Latest Images'); ?></h2>
        <?php
        $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '3';
        set_loop_records('items', get_recent_items($homepageRecentItems));
        if (has_loop_records('items')):
        ?>
    <div class="flexslider">
        <ul class="slides">
        <?php foreach (loop('items') as $item): ?>
        <li class="item">
            <h3><?php echo link_to_item(); ?></h3>
            <?php echo item_image_gallery(array(), 'thumbnail'); ?>
            <?php if($itemDescription = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                <p class="item-description"><?php echo $itemDescription; ?></p>
               <?php if(metadata('item','Collection Name')): ?>
                  <p id="collection" class="element">
                    <?php echo __('See more images from the '); ?>
                    <span class="element-text"><?php echo link_to_collection_for_item(); ?></span> collection.
                  </p>
               <?php endif; ?>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
        </ul>
    </div>
        <?php else: ?>
        <!-- <?php echo __('No recent items available.'); ?> -->
        <?php endif; ?>
    </div><!-- end recent-items -->
    


</div><!-- end primary -->

<div id="secondary">
    <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
    <?php echo $homepageText; ?>
    <?php endif; ?>
    <?php if (get_theme_option('Display Featured Item') == 1): ?>
    <!-- Featured Item -->
    <div id="featured-item">
        <h2><?php echo __('Featured Item'); ?></h2>
        <?php echo random_featured_items(1); ?>
    </div><!--end featured-item-->
    <?php endif; ?>
    <?php if (get_theme_option('Display Featured Collection')): ?>
    <!-- Featured Collection -->
    <div id="featured-collection">
        <h2><?php echo __('Featured Collection'); ?></h2>
        <?php echo random_featured_collection(); ?>
    </div><!-- end featured collection -->
    <?php endif; ?>
    <?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <!-- Featured Exhibit -->
    <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
    <?php endif; ?>

    <?php fire_plugin_hook('public_home', array('view' => $this)); ?>

</div><!-- end secondary -->
<?php echo foot(); ?>
