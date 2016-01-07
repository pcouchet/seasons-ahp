<?php
queue_js_url("http://maps.google.com/maps/api/js?sensor=false");
queue_js_file('map');
// Modifier le css de la carte
$css = "
            #map_browse {
                height: 800px;
            }
            .balloon {width:400px !important; font-size:1.2em;}
            .balloon .title {font-weight:bold;margin-bottom:1.5em;}
            .balloon .title, .balloon .description {float:left; width: 220px;margin-bottom:1.5em;}
            .balloon img {float:right;display:block;}
            .balloon .view-item {display:block; float:left; clear:left; font-weight:bold; text-decoration:none;}
            #map-links a {
                display:block;
            }
            #search_block {
                clear: both;
            }
						#content{padding-left:3%;padding-right:3%;}
						.night a:link, .night a:visited{color:grey;}
            ";
queue_css_string($css);

echo head(array('title' => __('Browse Map'),'bodyid'=>'map','bodyclass' => 'browse')); ?>




<div id="map_block">
<h2 style="margin-bottom:0"><?php echo __('Parcourir la carte');?> (<?php echo $totalItems; ?> <?php echo __('total');?>)</h2>
    <?php echo $this->googleMap('map_browse', array('loadKml'=>true, 'list'=>'map-links'));?>
</div><!-- end map_block -->

<div class="pagination" style="margin:0;padding:0;">
    <?php echo pagination_links(); ?>
</div><!-- end pagination -->

<div id="link_block">
    <div id="map-links"><h2><?php echo __('Trouver sur la carte'); ?></h2></div><!-- Used by JavaScript -->
</div><!-- end link_block -->


<?php echo foot(); ?>