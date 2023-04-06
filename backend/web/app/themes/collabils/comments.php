<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                _nx('One comment', '%1$s comments', get_comments_number(), 'comments title', 'your_theme_text_domain'),
                number_format_i18n(get_comments_number())
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e('Comment navigation', 'your_theme_text_domain'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'your_theme_text_domain')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'your_theme_text_domain')); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'your_theme_text_domain'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>

</div>
