<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap-child
 */
?>

<div class="wrapper" id="wrapper-footer-full">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'maf_footer' ) ): ?>
                    <ul>
                        <?php dynamic_sidebar( 'maf_footer' ); ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'maf_footer-2' ) ): ?>
                    <ul>
                        <?php dynamic_sidebar( 'maf_footer-2' ); ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'maf_footer-3' ) ): ?>
                    <ul>
                        <?php dynamic_sidebar( 'maf_footer-3' ); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
