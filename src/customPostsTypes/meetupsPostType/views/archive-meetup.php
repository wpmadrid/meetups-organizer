<?php get_header() ?>
<section class="mo-articles-list">
    <h1><?php _e( 'Meetups', 'meetups_organizer_textdomain' ) ?></h1>
    <?php if ( have_posts() ) : ?>
        <div class="mo-articles-container">
            <?php while( have_posts() ) : the_post(); ?>
                <a href="<?php echo get_the_permalink() ?>" title="<?php echo get_the_title() ?>">
                    <?php if ( $featured_image = get_the_post_thumbnail_url( $post->ID, 'medium' ) ) : ?>
                        <article class="mo-article" style="background-image: url('<?php echo $featured_image ?>')">
                    <?php else : ?>
                        <article class="mo-article" style="background-color: #39CDC6">
                    <?php endif;
                        if ( $meetup_date = get_field( '_meetup_date', $post->ID ) ) : ?>
                            <p class="mo-article-date"><img src="<?php echo WPMAD_MO_PLUGIN_URL . 'inc/images/calendar.svg' ?>" alt="<?php _e( 'Date of Meetup', 'meetups_organizer_textdomain' ) ?>"/><?php echo $meetup_date ?></p>
                        <?php endif ?>
                        <p class="mo-article-title"><?php echo get_the_title() ?></p>
                        <?php if ( $terms = get_the_terms( $post->ID, 'subject' ) ) : ?>
                            <p class="mo-article-authors"><?php echo $terms[0]->name ?></p>
                        <?php endif ?>
                    </article>
                </a>
            <?php endwhile ?>
        </div>
        <?php the_posts_pagination();
    endif; ?>
</section>
<?php get_footer();
