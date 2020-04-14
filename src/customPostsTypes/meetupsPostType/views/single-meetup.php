<?php get_header();

if ( $featured_image = get_the_post_thumbnail_url( $post->ID, 'large' ) ) :
    $section_style = '--background-image: url(\'' . $featured_image . '\')';
else :
    $section_style = 'background-color: #39CDC6';
endif;

$meetup_chat_enabled = get_field( '_meetup_chat_enabled' );
$class_comments      = $meetup_chat_enabled ? 'mo-video-comments' : 'mo-video-single'; ?>

<section class="mo-hero" style="<?php echo $section_style ?>">
    <div class="<?php echo $class_comments ?>">
        <div class="mo-video">
            <?php if ( $meetup_video_code = get_field( '_meetup_video_code' ) ) : ?>
                <iframe class="mo-hidden" width="560" height="349" src="<?php echo 'https://www.youtube.com/embed/' . $meetup_video_code . '?controls=0' ?>" frameborder="0" allowfullscreen></iframe>
                <?php if ( $meetup_chat_enabled ) : ?>
                    <iframe src="https://www.youtube.com/live_chat?v=<?php echo $meetup_video_code ?>&embed_domain=<?php echo $_SERVER['SERVER_NAME'] ?>" width="560" height="349" frameborder="0" allowfullscreen></iframe>
                <?php endif;
            endif; ?>
        </div>
    </div>
    <div class="mo-hero-content">
        <?php if ( $meetup_video_code ) : ?>
            <button class="mo-play-button"><img src="<?php echo WPMAD_MO_PLUGIN_URL . 'inc/images/play-button.svg' ?>" alt="<?php _e( 'Play video', 'meetups_organizer_textdomain' ) ?>" /></button>
        <?php endif ?>
        <h1><?php echo get_the_title() ?></h1>
        <div class="mo-meta">
            <p class="mo-meta-date"><?php echo get_the_date() ?></p>
            <?php if ( $terms = get_the_terms( $post->ID, 'subject' ) ) : ?>
                <p class="mo-meta-info"><?php echo $terms[0]->name ?></p>
            <?php endif ?>
        </div>
    </div>
</section>
<?php if ( have_rows( '_meetup_speakers' ) ) : ?>
    <section class="mo-authors">
        <?php while( have_rows( '_meetup_speakers' ) ) : the_row(); ?>
            <div class="mo-author">
                <?php if ( $meetup_speaker_photo = get_sub_field( '_meetup_speaker_photo' ) ) :
                    $meetup_speaker_link = ( $value = get_sub_field( '_meetup_speaker_link' ) ) ? $value : array( 'url' => '#', 'title' => '', 'target' => '' ); ?>
                    <a href="<?php echo $meetup_speaker_link['url'] ?>" title="<?php echo $meetup_speaker_link['title'] ?>" target="<?php echo $meetup_speaker_link['target'] ?>">
                        <img src="<?php echo $meetup_speaker_photo['url'] ?>" alt="<?php echo $meetup_speaker_photo['alt'] ?>">
                        <?php if ( $meetup_speaker_name = get_sub_field( '_meetup_speaker_name' ) ) : ?>
                            <p><?php echo $meetup_speaker_name ?></p>
                        <?php endif ?>
                    </a>
                <?php endif ?>
            </div>
        <?php endwhile ?>
    </section>
<?php endif ?>
<section>
    <?php echo $post->post_content ?>
</section>
<?php if ( $terms ) :
    $terms = array_map( function( $term ) {
        return $term->term_id;
    }, $terms );

    $args = array(
        'post_type'      => get_post_type( $post->ID ),
        'post__not_in'   => array( $post->ID ),
        'posts_per_page' => '3',
        'no_found_rows'  => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'subject',
                'field'    => 'id',
                'terms'    => $terms,
            ),
        ),
    );
    $custom_query = new WP_Query( $args );
    
    if ( $custom_query->have_posts() ) : ?>
        <section class="mo-more-articles">
            <h2 class="mo-subtitle"><?php _e( 'Related Meetups', 'meetups_organizer_textdomain' ) ?></h2>
            <div class="mo-articles-container">
                <?php while( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                    <a href="<?php echo get_the_permalink() ?>" title="<?php echo get_the_title() ?>">
                        <article class="mo-article">
                            <p class="mo-article-date"><?php echo get_the_date() ?></p>
                            <p class="mo-article-title"><?php echo get_the_title() ?></p>
                            <?php if ( $terms = get_the_terms( $post->ID, 'subject' ) ) : ?>
                                <p class="mo-article-authors"><?php echo $terms[0]->name ?></p>
                            <?php endif ?>
                        </article>
                    </a>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </section>
    <?php endif;
endif;

get_footer();
