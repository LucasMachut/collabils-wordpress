<?php
/**
 * Template Name: Custom Login Page
 */

// Rediriger l'utilisateur s'il est déjà connecté
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

// Gérer les erreurs de connexion
if (isset($_GET['login']) && $_GET['login'] == 'failed') {
    $error = '<div class="alert alert-danger">Identifiant ou mot de passe incorrect.</div>';
}

get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1><?php the_title(); ?></h1>
                    <?php if (isset($error)) : ?>
                        <?php echo $error; ?>
                    <?php endif; ?>
                    <?php
                    $args = array(
                        'echo' => true,
                        'redirect' => home_url(),
                        'form_id' => 'custom_loginform',
                        'label_username' => __('Username or Email', 'collabils'),
                        'label_password' => __('Password', 'collabils'),
                        'label_remember' => __('Remember Me', 'collabils'),
                        'label_log_in' => __('Log In', 'collabils'),
                        'value_remember' => true
                    );
                    wp_login_form($args);
                    ?>
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
