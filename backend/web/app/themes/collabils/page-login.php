<?php
/*
 * Template Name: Login Page
 */
get_header();
?>

<?php get_template_part('template_parts/header_menu.php') ?>


<?php echo do_shortcode('[ultimatemember form_id="148"]'); ?>
<style>
/* Couleur de fond du formulaire de connexion */
.um-login {
  background-color: #f1f1f1;
}

/* Couleur de fond du champ de saisie */
.um-field-area input {
  background-color: #fff;
}

/* Couleur du texte de l'étiquette */
.um-field-label label {
  color: #333;
}

/* Couleur de fond et bordure du bouton de soumission */
.um-button {
  background-color: #333;
  border: 1px solid #333;
  color: #fff;
}

/* Changement de la couleur de fond du bouton de soumission lorsqu'il est survolé */
.um-button:hover {
  background-color: #fff;
  color: #333;
}

/* Positionnement du texte "Forgot your password?" en bas du formulaire */
.um-col-alt-b {
  text-align: center;
  margin-top: 10px;
}
</style>