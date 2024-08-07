<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and is a fallback
 * for all other template files if a more specific template is not available.
 */

get_header(); ?>

<main id="main">
    <div class="content container">
        <div class="prose">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();

                    // Include the template for the page.
                    the_content();

                endwhile;

            else :
                // If no content, include the "No posts found" template.
                get_template_part('template-parts/content', 'none');

            endif;
            ?>
        </div>
    </div><!-- .content -->
</main><!-- #main -->

<?php
get_footer();
