<?php
/**
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

       <?php echo sprintf('<a href="%s" rel="bookmark">%s</a>', esc_url(get_permalink()), get_the_post_thumbnail( $post->ID, 'large' )); ?>

		<div class="entry-content">

	            <?php
	                $exerpt = get_the_excerpt();
                    $maxWords = 25;
                    if (str_word_count($exerpt, 0) > $maxWords) {
                        $exerpt = substr(strip_tags($exerpt), 0, 250).'...';
                    }
                    echo $exerpt;
	            ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				) );
			?>

		</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
