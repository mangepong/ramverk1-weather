<?php

namespace Anax\View;

?><h1>Weather Check</h1>
<form class="stylechooser" method="post">
    <fieldset>
        <legend>Weather</legend>
        <p>
            <label for="weather">Skriv en IP:<br>
                <input type="text" name="ip" value="<?= $ip ?>"></input><br><br>
                <input type="submit" value="Submit">
            </label>
            <p>Det visas för de kommande 7 dagarna.</p>
        </p>
    </fieldset>
</form>


<form action="weatherjson" class="stylechooser" method="get">
    <fieldset>
        <legend>Weather Json</legend>
        <p>
            <label for="ipvalidator">Skriv en IP:<br>
                <input type="text" name="ip" value="<?= $ip ?>"></input><br><br>
                <input type="submit" value="Submit">
            </label>
            <p>Formuläret gör en GET-request till <code>/weatherjson</code> med den IP som du skickar med liknande <code>/weatherjson?ip=&lt;ip&gt;</code></p>
            <p>Svaret visar information i JSON format.</p>
            <h4>Exempel routes</h4>
            <p><a href="weatherjson?ip=2001:4860:4860::8888">2001:4860:4860::8888</a> Google IP</p>
            <p><a href="weatherjson?ip=8.8.8.8.1">8.8.8.8.1</a> Dålig IP</p>
        </p>
    </fieldset>
</form>



