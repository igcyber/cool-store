<?php

function moneyFormat(string $str) :string
{
    return 'Rp. ' . number_format($str, 0, '', '.');
}

function dateId($tanggal)
{
    $value = Carbon\Carbon::parse($tanggal);
    $parse = $value->locale('id');
    return $parse->translatedFormat('l, d F Y');
}
