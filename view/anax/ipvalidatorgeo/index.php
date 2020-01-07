<?php

namespace Anax\View;

?><h1>Ip Validator</h1>
<form class="stylechooser" method="post">
    <fieldset>
        <legend>Ip Validator</legend>
        <p>
            <label for="ipvalidator">Skriv en IP:<br>
                <input type="text" name="ip" value="<?= $ip ?>"></input><br><br>
                <input type="submit" value="Submit">
            </label>
        </p>
    </fieldset>
</form>
<form action="ipjsongeo" class="stylechooser" method="get">
    <fieldset>
        <legend>Ip Validator Json</legend>
        <p>
            <label for="ipvalidator">Skriv en IP:<br>
                <input type="text" name="ip" value="<?= $ip ?>"></input><br><br>
                <input type="submit" value="Submit">
            </label>
            <p>Formuläret gör den GET-request till <code>/ipjsongeo</code> med den IP som du skickar med liknande <code>/ipjsongeo?ip=&lt;ip&gt;</code></p>
            <p>Svaret visar information i JSON format.</p>
            <h4>Exempel routes</h4>
            <p><a href="ipjsongeo?ip=2001:4860:4860::8888">2001:4860:4860::8888</a> Google IP</p>
            <p><a href="ipjsongeo?ip=8.8.8.8.1">8.8.8.8.1</a> Dålig IP</p>
        </p>
    </fieldset>
</form>



