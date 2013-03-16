<?php
/*
Template Name: Buchen
*/

use Respect\Validation\Validator as v;

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

    // Validate post
    $postValidator = v::allOf(
        v::key('start', v::date())->setName('Datum'),
        v::key('booking_name', v::notEmpty())->setName('Vorname und Nachname'),
        v::key('booking_email', v::email()->notEmpty())->setName('E-Mail-Adresse')
    )->setName('Buchungsformular');

    try {
        $postValidator->assert($_POST);
        require_once 'parts/booking-ok.php';
    } catch (\Respect\Validation\Exceptions\AllOfException $e) {
        ?><h2 class="error">Bitte prüfe dein Eingaben!</h2>
        <ul class="error">
        <?php
        foreach ($e->findMessages(array('start' => 'Ungültiges Datum angegeben.', 'booking_name' => 'Darf nicht leer sein.', 'booking_email' => 'Ungültige E-Mail-Adresse angegeben.')) as $k => $message) {
            if (empty($message)) continue;
            ?>
            <li>
            <?php echo $message; ?>
            </li><?php
        }
        ?></ul><?php
        require_once 'parts/booking-form.php';
    }
    require_once 'parts/booking-ok.php';
} else {
    require_once 'parts/booking-form.php';
}

?>

<?php get_footer(); ?>