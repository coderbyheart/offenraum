<?php

while (have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php endwhile; ?>
<?php

// TODO: Optimize
$bookingsQuery = new WP_Query(sprintf('post_type=booking&post_status=publish'));
$bookings = array();
if ($bookingsQuery->have_posts()) {
    while ($bookingsQuery->have_posts()) {
        $bookingsQuery->the_post();
        $date = get_post_meta($post->ID, 'booking_date', true);
        $free = get_post_meta($post->ID, 'booking_free', true);
        $bookings[$date] = (int)$free / 100;
    }
}
wp_reset_query();
?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">

    <p>
        <small class="required">* Angabe erforderlich</small>
    </p>

    <fieldset>
        <legend>Wann möchtest Du uns besuchen?</legend>

        <div class="clearfix">

            <?php

            $today = new DateTime();

            for ($m = 0; $m < 3; $m++):

                $start = new DateTime(strftime('%Y-%m-01 00:00:00'));
                if ($m > 0) $start->modify(sprintf('+%d month', $m));
                $begin = new DateTime($start->format('Y-m-d 00:00:00'));
                while ($begin->format('N') != '1') { // not monday
                    $begin->modify('-1 day');
                }

                $headerMonth = strftime('%B', $start->format('U'));

                $curr = new DateTime($begin->format('Y-m-d 00:00:00'));
                $headerWeekDays = array();
                $headerDate = new DateTime($begin->format('Y-m-d 00:00:00'));
                for ($i = 0; $i < 7; $i++) {
                    $headerWeekDays[] = strftime('%a', $headerDate->format('U'));
                    $headerDate->modify('+1 day');
                }

                $weekDays = array(array());
                $week = 0;
                $thisMonth = (int)$start->format('m');
                $nextMonth = ($thisMonth + 1) % 12;
                while (count($weekDays[$week]) != 7) {
                    $free = 1;
                    if ($curr->format('N') > 5) $free = 0;
                    if (isset($bookings[$curr->format('Y-m-d')])) $free = $bookings[$curr->format('Y-m-d')];
                    $d = array(
                        'label' => $curr->format('j'),
                        'date' => $curr->format('j.n.Y'),
                        'inmonth' => (int)$curr->format('m') == $thisMonth,
                        'free' => $free,
                        'ispast' => !$curr->diff($today)->invert,
                    );

                    $weekDays[$week][] = $d;
                    $curr->modify('+1 day');
                    if (count($weekDays[$week]) == 7 && (int)$curr->format('m') != $nextMonth) {
                        $week++;
                        $weekDays[$week] = array();
                    }
                }

                ?>
                <table class="calendar" data-target="input[name=start]">
                    <thead>
                    <tr>
                        <th colspan="7"><?php echo $headerMonth; ?></th>
                    </tr>
                    <tr>
                        <?php foreach ($headerWeekDays as $w): ?>
                        <th><?php echo $w; ?></th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($weekDays as $week => $days): ?>
                    <tr>
                        <?php foreach ($days as $day):
                        $classes = array();
                        $title = '';
                        if (!$day['inmonth']) $classes[] = 'offmonth';
                        if ($day['ispast']) $classes[] = 'past';
                        if (!$day['ispast'] && $day['inmonth']) {
                            if ($day['free'] > 0.5) {
                                $classes[] = 'free';
                                $title = 'Noch freie Plätze verfügbar.';
                            } else if ($day['free'] > 0) {
                                $classes[] = 'busy';
                                $title = 'Noch wenige Plätze verfügbar.';
                            } else {
                                $classes[] = 'closed';
                                $title = 'Keine Plätze verfügbar.';
                            }
                        }
                        ?>
                        <td class="<?php echo join(" ", $classes); ?>" data-date="<?php echo $day['date']; ?>">
                            <?php if($title): ?><abbr title="<?php echo $title; ?>"><?php endif; ?>
                                <?php echo $day['label']; ?>
                            <?php if($title): ?></abbr><?php endif; ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php

            endfor; // for($m = 0; $m < 3; $m++)

            ?>

        </div>
        <!-- .clearfix -->

        <label>Datum
            <small class="required">*</small>
            <br>
            <input type="text" name="start" value="" pattern="[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}" required placeholder="<?php echo date('j.n.Y'); ?>"></label>

    </fieldset>

    <fieldset>
        <legend>Persönliche Daten</legend>
        <p><label> Vorname und Nachname
            <small class="required">*</small>
            <br> <input type="text" name="booking_name" required> </label>
        </p>
        <p>
            <label> E-Mail-Adresse
                <small class="required">*</small>
                <br> <input type="email" name="booking_email" required> </label>
        </p>
        <p>
            <label> Telefon <br> <input type="text" name="booking_phone"></label>
        </p>
    </fieldset>

    <fieldset>
        <legend>Noch was?</legend>
        <p>
            <label> Bemerkung<br> <textarea rows="3" cols="60" name="booking_text"></textarea> </label>
        </p>
    </fieldset>

    <fieldset>
        <legend>Ab die Post!</legend>
        <p>
            <button type="submit" class="alignright">absenden</button>
        </p>
        <p>
            <small>Hinweis: wir speichern deine IP-Adresse zusammen mit dieser Anfrage.</small>
        </p>
    </fieldset>
</form>