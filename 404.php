<?php
/**
 * The template for displaying 404 pages (Page Not Found).
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<?php get_header(); ?>

	<?php do_action( 'spacious_before_body_content' );

		$page_requested = get_page_by_path($_SERVER['REQUEST_URI']);
		$page_status = get_post_status( $page_requested->ID );
		if( $page_status == 'private' && ! is_user_logged_in() ){
			echo "<h2>This page requires a member login, please login below to view this page</h2>";
		} else { ?>

            <div id="primary">
                <div id="content" class="clearfix">
                    <section class="error-404 not-found">
                        <div class="page-content">

                            <?php if ( ! dynamic_sidebar( 'spacious_error_404_page_sidebar' ) ) : ?>
                                <header class="page-header">
                                    <h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'spacious' ); ?></h2>
                                </header>
                                <p><?php _e( 'It looks like nothing was found at this location. Try the search below.', 'spacious' ); ?></p>
                                <?php get_search_form(); ?>
                            <?php endif; ?>

                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                </div><!-- #content -->
            </div><!-- #primary -->
        <?php }

	spacious_sidebar_select(); ?>

	<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>