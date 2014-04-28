<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" 
  lang="<?php echo get_html_lang(); ?>"
  prefix="  bibo: http://purl.org/ontology/bibo/  cc: http://creativecommons.org/ns#  dcmitype: http://purl.org/dc/dcmitype/  dcterms: http://purl.org/dc/terms/  foaf: http://xmlns.com/foaf/0.1/  nm: http://nomisma.org/id/  owl:  http://www.w3.org/2002/07/owl#  rdfs: http://www.w3.org/2000/01/rdf-schema#   rdfa: http://www.w3.org/ns/rdfa#  rdf:  http://www.w3.org/1999/02/22-rdf-syntax-ns#  skos: http://www.w3.org/2004/02/skos/core#  "
  >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes" />
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>
    <!-- Stylesheets -->
    <?php
    queue_css_file('flexslider');
    queue_css_file('style');

    echo head_css();
    ?>
    <!-- JavaScripts -->
    <?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)')); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('globals'); ?>
    <?php queue_js_file('vendor/flexslider/jquery.flexslider-min', 'javascripts'); ?>
    <?php echo head_js(); ?>
    <script type="text/javascript" charset="utf-8">
        window.onload = function() {
        jQuery('.flexslider').flexslider();
      };
    </script>
</head>
 <?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
        <header>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            <div id="site-title"><?php echo link_to_home_page(theme_logo()); ?></div>

            <div id="search-container">
                <h2>Search</h2>
                    <?php echo search_form(array('show_advanced'=>TRUE)); ?>
            </div>
        </header>

         <div id="primary-nav">
             <?php
                  echo public_nav_main();
             ?>
         </div>
  
         <div id="mobile-nav">
             <?php
                  echo public_nav_main();
             ?>
         </div>
        
        <?php echo theme_header_image(); ?>
                       
    <div id="content">

<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
