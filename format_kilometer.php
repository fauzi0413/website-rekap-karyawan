<?php

function jarak($angka)
{

    $hasil_jarak = number_format($angka, 0, ',', '.') . " KM";
    return $hasil_jarak;
}
