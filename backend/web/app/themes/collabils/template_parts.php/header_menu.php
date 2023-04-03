<?php
?>

<header class="header">
    <?php 
    wp_nav_menu([
        'theme_location' => "menu_light",
        'container' => 'nav',
        'container_class' => 'menu navbar-expand-sm navbar-dark fixed-top',
        'menu_class' => 'menu__list'
    ]);
    ?>
  </header>