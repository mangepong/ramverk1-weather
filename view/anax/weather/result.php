<?php

namespace Anax\View;

?><h1>Weather Check</h1>
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
</head>

<div id="mapid"></div>

<script>

    // var lat = document.getElementbyId("latitude");
    // var long = document.getElementbyId("longitude");

    var mymap = L.map('mapid').setView([<?= $lat ?>, <?= $long ?>], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibWFuZ2Vwb25nIiwiYSI6ImNrM3N2emw5MDA4ejEzZG8xc21qY2JlZ24ifQ.DgntgLEnOPmn0alKrO3NRQ'
}).addTo(mymap);

var marker = L.marker([<?= $lat ?>, <?= $long ?>]).addTo(mymap);
</script>

<form class="stylechooser">
    <fieldset>
        <legend><?= gmdate("Y-m-d", $res[0]["daily"]["data"][0]["time"]) ?></legend>
        <div class="weatherres">
            <p>
                <p><?= $res[0]["daily"]["data"][0]["summary"] ?></p>
                <p>Högsta temperatur: <?= $res[0]["daily"]["data"][0]["temperatureMax"] ?></p>
                <p>Lägsta temperatur: <?= $res[0]["daily"]["data"][0]["temperatureMin"] ?></p>
            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend><?= gmdate("Y-m-d", $res[1]["daily"]["data"][0]["time"]) ?></legend>
        <div class="weatherres">
            <p>
                <p><?= $res[1]["daily"]["data"][0]["summary"] ?></p>
                <p>Högsta temperatur: <?= $res[1]["daily"]["data"][0]["temperatureMax"] ?></p>
                <p>Lägsta temperatur: <?= $res[1]["daily"]["data"][0]["temperatureMin"] ?></p>
            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend><?= gmdate("Y-m-d", $res[2]["daily"]["data"][0]["time"]) ?></legend>
        <div class="weatherres">
            <p>
                <p><?= $res[2]["daily"]["data"][0]["summary"] ?></p>
                <p>Högsta temperatur: <?= $res[2]["daily"]["data"][0]["temperatureMax"] ?></p>
                <p>Lägsta temperatur: <?= $res[2]["daily"]["data"][0]["temperatureMin"] ?></p>
            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend><?= gmdate("Y-m-d", $res[3]["daily"]["data"][0]["time"]) ?></legend>
        <div class="weatherres">
            <p>
                <p><?= $res[3]["daily"]["data"][0]["summary"] ?></p>
                <p>Högsta temperatur: <?= $res[3]["daily"]["data"][0]["temperatureMax"] ?></p>
                <p>Lägsta temperatur: <?= $res[3]["daily"]["data"][0]["temperatureMin"] ?></p>
            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend><?= gmdate("Y-m-d", $res[4]["daily"]["data"][0]["time"]) ?></legend>
        <div class="weatherres">
            <p>
                <p><?= $res[4]["daily"]["data"][0]["summary"] ?></p>
                <p>Högsta temperatur: <?= $res[4]["daily"]["data"][0]["temperatureMax"] ?></p>
                <p>Lägsta temperatur: <?= $res[4]["daily"]["data"][0]["temperatureMin"] ?></p>
            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend><?= gmdate("Y-m-d", $res[5]["daily"]["data"][0]["time"]) ?></legend>
        <div class="weatherres">
            <p>
                <p><?= $res[5]["daily"]["data"][0]["summary"] ?></p>
                <p>Högsta temperatur: <?= $res[5]["daily"]["data"][0]["temperatureMax"] ?></p>
                <p>Lägsta temperatur: <?= $res[5]["daily"]["data"][0]["temperatureMin"] ?></p>
            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend><?= gmdate("Y-m-d", $res[6]["daily"]["data"][0]["time"]) ?></legend>
        <div class="weatherres">
            <p>
                <p><?= $res[6]["daily"]["data"][0]["summary"] ?></p>
                <p>Högsta temperatur: <?= $res[6]["daily"]["data"][0]["temperatureMax"] ?></p>
                <p>Lägsta temperatur: <?= $res[6]["daily"]["data"][0]["temperatureMin"] ?></p>
            </p>
        </div>
    </fieldset>
</form>