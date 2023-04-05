<?php
/**
 * Template Name: Page d'inscription
 */

// Rediriger l'utilisateur s'il est déjà connecté
/* if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
} */

// Traiter le formulaire d'inscription s'il est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = collabils_check_errors(new WP_Error(), '', '');
    if (empty($errors->errors)) {
        $user_id = wp_create_user($_POST['user_login'], $_POST['password'], $_POST['email']);
        if (is_wp_error($user_id)) {
            $errors->add('collabils_registration_error', $user_id->get_error_message());
        } else {
            collabils_register_user_update($user_id);
            wp_safe_redirect(wp_login_url());
            exit;
        }
    }
}

function collabils_check_errors($errors, $user_login, $user_email)
{
    // On vérifie que tous les champs sont remplis
    if (empty($_POST['first_name'])) {
        $errors->add('collabils_registration_error', __('You must enter a first name.', 'collabils'));
    }

    if (empty($_POST['last_name'])) {
        $errors->add('collabils_registration_error', __('You must enter a last name.', 'collabils'));
    }

    if (empty($_POST['email'])) {
        $errors->add('collabils_registration_error', __('You must enter an email address.', 'collabils'));
    }

    if (empty($_POST['password'])) {
        $errors->add('collabils_registration_error', __('You must enter a password.', 'collabils'));
    }

    if (empty($_POST['role'])) {
        $errors->add('collabils_registration_error', __('You must choose a role.', 'collabils'));
    }

    if (empty($_POST['universite_diplome'])) {
        $errors->add('collabils_registration_error', __('You must enter your university.', 'collabils'));
    }

    if (empty($_POST['date_diplome'])) {
        $errors->add('collabils_registration_error', __('You must enter your graduation date.', 'collabils'));
    }

    // On vérifie que l'email n'est pas déjà utilisé
    if (email_exists($_POST['email'])) {
        $errors->add('collabils_registration_error', __('This email address is already registered.', 'collabils'));
    }

    // On vérifie que le pseudo n'est pas déjà utilisé
    if (username_exists($_POST['pseudo'])) {
        $errors->add('collabils_registration_error', __('This username is already taken.', 'collabils'));
    }

    // On vérifie que le rôle est valide
    if ($_POST['role'] !== 'etudiant' && $_POST['role'] !== 'interprete') {
        $errors->add('collabils_registration_error', __('Invalid role.', 'collabils'));
    }

    return $errors;
}

function collabils_register_user_update($user_id)
{
    global $wpdb;

    // On met à jour l'utilisateur avec les données du formulaire
    wp_update_user([
        'ID' => $user_id,
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'user_pass' => $_POST['password'],
    ]);

    // Ajout des métadonnées pour l'utilisateur
    update_user_meta($user_id, 'pseudo', $_POST['pseudo']);
    update_user_meta($user_id, 'role', $_POST['role']);
    update_user_meta($user_id, 'universite_diplome', $_POST['universite_diplome']);
    update_user_meta($user_id, 'date_diplome', $_POST['date_diplome']);

    // Créer un nouveau post de type 'interprete' ou 'etudiant' selon le rôle de l'utilisateur
    $post_id = wp_insert_post([
        'post_author' => $user_id,
        'post_type' => $_POST['role'] === "interprete" ? "interpretes" : "etudiants",
        'post_status' => 'publish',
        'post_content' => '',
        'post_title' => $_POST['first_name'] . " " . $_POST['last_name']
    ]);

    // On relie le post à l'utilisateur via la table personnalisée (user_id, post_id)
    $wpdb->insert('wp_collabils_user_post', [
        'user_id' => $user_id,
        'post_id' => $post_id
    ]);
}

function collabils_login_redirect( $redirect_to, $request, $user ) {
    // Récupérer l'URL de la page de connexion personnalisée
    $login_page = home_url('/connexion/');

    // Vérifier si l'utilisateur est un administrateur
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'administrator', $user->roles ) ) {
            // Rediriger l'administrateur vers le tableau de bord
            return admin_url();
        } else {
            // Rediriger tous les autres utilisateurs vers la page de connexion personnalisée
            return $login_page;
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'collabils_login_redirect', 10, 3 );


// Afficher le formulaire d'inscription
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1><?php the_title(); ?></h1>
                    <?php if (isset($errors) && !empty($errors->errors)) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors->get_error_messages() as $error) : ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <p>
                            <label for="user_login"><?php _e('Username', 'collabils'); ?><br />
                                <input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr(wp_unslash($_POST['user_login'] ?? '')); ?>" size="25" /></label>
                        </p>

                        <p>
                            <label for="password"><?php _e('Password', 'collabils'); ?><br />
                                <input type="password" name="password" id="password" class="input" value="" size="25" /></label>
                        </p>

                        <p>
                            <label for="first_name"><?php _e('First Name', 'collabils'); ?><br />
                                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(wp_unslash($_POST['first_name'] ?? '')); ?>" size="25" /></label>
                        </p>

                        <p>
                            <label for="last_name"><?php _e('Last Name', 'collabils'); ?><br />
                                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(wp_unslash($_POST['last_name'] ?? '')); ?>" size="25" /></label>
                        </p>

                        <p>
                            <label for="pseudo"><?php _e('Pseudo', 'collabils'); ?><br />
                                <input type="text" name="pseudo" id="pseudo" class="input" value="<?php echo esc_attr(wp_unslash($_POST['pseudo'] ?? '')); ?>" size="25" /></label>
                        </p>

                        <p>
                            <label for="email"><?php _e('Email', 'collabils'); ?><br />
<input type="email" name="email" id="email" class="input" value="<?php echo esc_attr(wp_unslash($_POST['email'] ?? '')); ?>" size="25" /></label>
</p>
<p>
                        <label for="role"><?php _e('Role', 'collabils'); ?><br />
                            <select name="role" id="role">
                                <option value="etudiant"<?php selected($_POST['role'] ?? '', 'etudiant'); ?>><?php _e('Etudiant', 'collabils'); ?></option>
                                <option value="interprete"<?php selected($_POST['role'] ?? '', 'interprete'); ?>><?php _e('Interprète', 'collabils'); ?></option>
                            </select>
                        </label>
                    </p>

                    <p>
                        <label for="universite_diplome"><?php _e('Université', 'collabils'); ?><br />
                            <input type="text" name="universite_diplome" id="universite_diplome" class="input" value="<?php echo esc_attr(wp_unslash($_POST['universite_diplome'] ?? '')); ?>" size="25" /></label>
                    </p>

                    <p>
                        <label for="date_diplome"><?php _e('Date de diplôme', 'collabils'); ?><span class="required">*</span></label>
                        <input type="date" name="date_diplome" id="date_diplome" class="input" value="<?php if (!empty($_POST['date_diplome'])) echo esc_attr($_POST['date_diplome']); ?>" required="required" />
                    </p>

                    <p>
                        <input type="submit" class="button" value="<?php _e('Register', 'collabils'); ?>" />
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>
</div>
<?php get_footer(); ?>
