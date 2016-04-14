<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
/*
 * show private posts in widget list of archives
 */
function customarchives_where( $x ) {
	return $x . " OR (post_type = 'post' AND post_status = 'private')";
}

if ( is_user_logged_in() ) {
    add_filter( 'getarchives_where', 'customarchives_where' );
}

/**
 * Shows meta information of post.  Removed author and edit links
 * Overrides theme function of same name (props to theme authors for checking)
 */
function spacious_entry_meta() {
   if ( 'post' == get_post_type() ) :
      echo '<footer class="entry-meta-bar clearfix">';
      echo '<div class="entry-meta clearfix">';
      
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
      if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
         $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
      }
      $time_string = sprintf( $time_string,
         esc_attr( get_the_date( 'c' ) ),
         esc_html( get_the_date() ),
         esc_attr( get_the_modified_date( 'c' ) ),
         esc_html( get_the_modified_date() )
      );
      printf( __( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'spacious' ),
         esc_url( get_permalink() ),
         esc_attr( get_the_time() ),
         $time_string
      ); ?>

      <?php if( has_category() ) { ?>
         <span class="category"><?php the_category(', '); ?></span>
      <?php } ?>

      <?php if ( comments_open() ) { ?>
         <span class="comments"><?php comments_popup_link( __( 'No Comments', 'spacious' ), __( '1 Comment', 'spacious' ), __( '% Comments', 'spacious' ), '', __( 'Comments Off', 'spacious' ) ); ?></span>
      <?php } ?>

      <?php if ( ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) != 'blog_full_content' ) && !is_single() ) { ?>
         <span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'spacious' ); ?></a></span>
      <?php } ?>

      <?php
      echo '</div>';
      echo '</footer>';
   endif;
}
/*
 * remove Private from post titles (including in archives)
 */
function the_title_trim($title)
{
  $pattern[0] = '/Protected:/';
  $pattern[1] = '/Private:/';
  $replacement[0] = ''; // Enter some text to put in place of Protected:
  $replacement[1] = ''; // Enter some text to put in place of Private:

  return preg_replace($pattern, $replacement, $title);
}
add_filter('the_title', 'the_title_trim');
