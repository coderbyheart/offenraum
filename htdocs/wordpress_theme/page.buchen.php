<?php
/*
Template Name: Buchen
*/

error_reporting(-1);
ini_set('display_errors', '1');

get_header();


?>
<h1>
    <?php bloginfo('title'); ?><br>
    <small><?php bloginfo('description'); ?></small>
</h1>
<?php

if (isset($_POST['start'])) {
    require_once 'parts/booking-ok.php';
} else {
    require_once 'parts/booking-form.php';
}

?>

<?php get_footer(); ?>