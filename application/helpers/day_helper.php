<?php

function indonesian_date($timestamp = '', $date_format = 'd F Y', $suffix = '')
{
    if ($timestamp == NULL) {
        return '-';
    }

    if ($timestamp == '1970-01-01' || $timestamp == '0000-00-00' || $timestamp == '-25200') {
        return '-';
    }

    if (trim($timestamp) == '') {
        $timestamp = time();
    } elseif (!ctype_digit($timestamp)) {
        $timestamp = strtotime($timestamp);
    }

    $date_format = preg_replace("/S/", "", $date_format);

    $pattern = array('/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/', '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/', '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/', '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/', '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^tober]/', '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/', '/April/', '/June/', '/July/', '/August/', '/September/', '/October/', '/November/', '/December/');

    $replace = array('Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des', 'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    $date = date($date_format, $timestamp);
    $date = preg_replace($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
}
