<?php
// Use this file to define customized helper functions, filters or 'hacks' defined
// specifically for use in your Omeka theme. Note that helper functions that are
// designed for portability across themes should be grouped into a plugin whenever
// possible. Ideally, you should namespace these with your theme name.

/**
 * Return the HTML for summarizing a random featured exhibit
 *
 * @return string
 */
function custom_exhibit_builder_display_random_featured_exhibit()
{
    $html = '<div id="featured-exhibit">';
    $featuredExhibit = exhibit_builder_random_featured_exhibit();
    $html .= '<h2> L\'exposition </h2>';
    if ($featuredExhibit) {
       $html .= '<h3>' . exhibit_builder_link_to_exhibit($featuredExhibit) . '</h3>'."\n";
       $html .= '<p>'.snippet_by_word_count(metadata($featuredExhibit, 'description', array('no_escape' => true))).'</p>';
    } else {
       $html .= '<p>' . __('You have no featured exhibits.') . '</p>';
    }
    $html .= '</div>';
    $html = apply_filters('exhibit_builder_display_random_featured_exhibit', $html);
    return $html;
}

function custom_item_image_gallery($attrs = array(), $imageType = 'square_thumbnail', $filesShow = false, $item = null)
{
    if (!$item) {
        $item = get_current_record('item');
    }

    $files = $item->Files;
    if (!$files) {
        return '';
    }

    $defaultAttrs = array(
        'wrapper' => array('id' => 'item-images'),
        'linkWrapper' => array(),
        'link' => array(),
        'image' => array()
    );
    $attrs = array_merge($defaultAttrs, $attrs);

    $html = '';
    if ($attrs['wrapper'] !== null) {
        $html .= '<div ' . tag_attributes($attrs['wrapper']) . '>'."\n";
    }
    foreach ($files as $file) {
        if ($attrs['linkWrapper'] !== null) {
            $html .= '<div ' . tag_attributes($attrs['linkWrapper']) . '>'."\n";
        }
				$fileTitle = metadata($file, 'display title');
        $webPath = $file->getWebPath('original');
        // Taille de l'image en fonction du type de fichier
        if(preg_match("/\.jpg$/",$webPath)){
        	$imageType = 'fullsize';
        	$attrs['image']=array('style'=>'max-width: 100%' );
        	}
        else{
        	$imageType = 'thumbnail';
        	$attrs['image']=array('style'=>'width:5em;vertical-align:middle;' );
        	}
        $image = file_image($imageType, $attrs['image'], $file);
        $html .= '<h2 class="title" style="text-align:center;">'.$fileTitle.'</h2>'."\n";
        if ($filesShow) {
            $html .= link_to($file, 'show', $image, $attrs['link']);
        } else {
		        if(preg_match("/\.pdf$/",$webPath)) $html .= '<p style="padding:0 1em 1em 1em;color: #333333;">T&eacute;l&eacute;charger le fichier PDF : ';
            $linkAttrs = $attrs['link'] + array('href' => $webPath);
            $html .= '<a ' . tag_attributes($linkAttrs) . '>' . $image . '</a>'."\n";
		        if(preg_match("/\.pdf$/",$webPath)) $html .= '</p>';
        }

        if ($attrs['linkWrapper'] !== null) {
            $html .= '</div>'."\n";
        }
    }
    if ($attrs['wrapper'] !== null) {
        $html .= '</div>'."\n";
    }
    return $html;
}

function custom_collectionTreeFullList($linkToCollectionShow = true)
{
    $rootCollections = get_db()->getTable('CollectionTree')->getRootCollections();
    // Return NULL if there are no root collections.
    if (!$rootCollections) {
        return null;
    }
    $collectionTable = get_db()->getTable('Collection');
    $html = '<ul id="collection-tree">';
    foreach ($rootCollections as $rootCollection) {
      //$html .= '<li>';

      $collectionTree = get_db()->getTable('CollectionTree')->getDescendantTree($rootCollection['id']);
      $class='';
      // boutton à droite si plus de 2 items
      if(count($collectionTree)>2) {
      $html .= '<button id="'.$rootCollection['id'].'" style="float:left; margin-right:1em">+</button>
      <script>
      jQuery(document).ready(function($){
        $( "ul.longlist'.$rootCollection['id'].'" ).hide();
        $( "button#'.$rootCollection['id'].'" ).click(function() {
          $( "ul.longlist'.$rootCollection['id'].'" ).toggle();
        });
      });
      </script>
      ';
      $class='longlist'.$rootCollection['id'];
      }
      if ($linkToCollectionShow) {
        $subCollContent = custom_collectionTreeList($collectionTree, $linkToCollectionShow, $class);
        if (empty($subCollContent)) $html .= '<h4>'.link_to_items_browse($rootCollection['name'], array("collection" => $rootCollection['id'])).'</h4>';
        else $html.='<h4>'.$rootCollection['name'].'</h4>';
      } else {
          $html .= $rootCollection['name'] ? $rootCollection['name'] : '[Untitled]';
      }
      $html .= custom_collectionTreeList($collectionTree, $linkToCollectionShow, $class);
      //$html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
function custom_collectionTreeList($collectionTree, $linkToCollectionShow = true, $class='')
{
    if (!$collectionTree) {
        return;
    }
    $collectionTable = get_db()->getTable('Collection');

    $html = '<ul class="'.$class.'">';
    foreach ($collectionTree as $collection) {
        $html .= '<li>';
        $subCollContent = custom_collectionTreeList($collection['children'], $linkToCollectionShow);
        if ($linkToCollectionShow && !isset($collection['current'])) {
           if (empty($subCollContent)) $html .= link_to_items_browse($collection['name'], $browseParams = array('collection' => $collection['id']));
           else $html .= $collection['name'];
           //$html .= link_to_collection(null, array(), 'show', $collectionTable->find($collection['id']));
        } else {
            $html .= $collection['name'] ? $collection['name'] : '[Untitled]';
        }
        $html .= $subCollContent;
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
