<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_home() ) {
	return false;
}

// check if woocommerce is active
if ( class_exists( 'WooCommerce' ) ) {
	if ( is_woocommerce() ) {
		return false;
	}
}

$image_id = false;
$title = '';
$description = '';

if ( is_singular() ) {
	$image_id = get_post_thumbnail_id( get_the_ID() );
	$title = get_the_title();
} elseif ( is_archive() ) {
	$image_id = get_term_meta( get_queried_object_id(), 'thumbnail_id', true );
	$title = get_the_archive_title();
	$description = get_the_archive_description();
}
?>

<header class="single-header container mt-3">

	<?php if ( $image_id ) echo wp_get_attachment_image( $image_id, 'large', false, array('class' => 'mb-2') ); ?>

	<?php smn_breadcrumb(); ?>

	<h1 class="entry-title"><?php echo $title; ?></h1>

	<?php if ( is_singular( 'post' ) ) { ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	<?php } ?>

	<?php if ( $description) { ?>
		
		<div class="lead"><?php echo $description; ?></div>
	
	<?php } ?>

</header>

<?php