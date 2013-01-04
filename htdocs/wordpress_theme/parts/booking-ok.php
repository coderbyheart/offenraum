<h2>Alles Roger!</h2>
<?php

$text = '';
foreach($_POST as $k => $v) {
    $text .= sprintf("%s\n%s\n\n", $k, $v);
}

mail('booking@offenraum.de', 'Buchungsanfrage von ' . $_SERVER['REMOTE_ADDR'], $text);

?>
<p>Vielen Dank für deine Anfrage. Wir werden uns umgehend mit dir in Verbindung setzen.</p>

<h2>Bleib in Kontakt!</h2>

<p>Bist Du schon unser Fan auf <a href="http://facebook.com/OFfenraum" rel="me" title="OFfenraum bei Facebook"><i class="icon-facebook-sign"></i> Facebook</a>?<br>
    Folgst Du uns schon auf <a href="http://twitter.com/OFfenraum" rel="me" title="OFfenraum bei Twitter"><i class="icon-twitter"></i> Twitter</a> oder <a href="https://plus.google.com/111661941086180047910" rel="me" title="OFfenraum bei Google+"><i class="icon-google-plus-sign"></i> Google+</a>?</p>

<p>Ganz oldschool kannst Du dich auch zu unserem <a href="http://offenraum.nanshe.tacker.lan/#kontakt">Newsletter</a> anmelden.</p>
