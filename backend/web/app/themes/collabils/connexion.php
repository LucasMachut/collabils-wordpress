<?php
/**
 * Template Name: Page de connexion
 */

// Rediriger l'utilisateur s'il est déjà connecté
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}


// Traiter le formulaire de connexion s'il est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = wp_signon($_POST);
    if (!is_wp_error($user)) {
        wp_safe_redirect(home_url());
        exit;
    }
}

// Afficher le formulaire de connexion
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1><?php the_title(); ?></h1>
                    <?php if (isset($user) && is_wp_error($user)) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($user->get_error_messages() as $error) : ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" enctype="multipart/form-data">
                        <p>
                            <label for="user_login"><?php _e('Username or Email', 'collabils'); ?><br />
                                <input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr(wp_unslash($_POST['log'] ?? '')); ?>" size="25" /></label>
                        </p>

                        <p>
                            <label for="password"><?php _e('Password', 'collabils'); ?><br />
                                <input type="password" name="pwd" id="password" class="input" value="" size="25" /></label>
                        </p>

                        <p>
                            <input type="submit" class="button" value="<?php _e('Log In', 'collabils'); ?>" />
                        </p>
                    </form>


                </div>
            </div>
            <div class="redirect-inscription">
                <p>Vous n'êtes pas encore inscrit ?</p>
                <a href="<?php echo home_url('/registration/'); ?>"><button class="bouton1">inscription</button></a>
            </div>

        </div>
    </main>
</div>
<?php get_footer(); ?>
