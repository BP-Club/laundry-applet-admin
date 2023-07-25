<?php
/**
 * 根据经纬度算距离，返回结果单位是公里，先纬度，后经度
 * @param $lat1
 * @param $lng1
 * @param $lat2
 * @param $lng2
 * @return float|intg
 */
function getDistance($lat1, $lng1, $lat2, $lng2)
{
    $EARTH_RADIUS = 6378.137;

    $radLat1 = rad($lat1);
    $radLat2 = rad($lat2);
    $a = $radLat1 - $radLat2;
    $b = rad($lng1) - rad($lng2);
    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
    $s = $s * $EARTH_RADIUS;
    $s = round($s * 10000) / 10000;

    return $s;
}

function rad($d)
{
    return $d * M_PI / 180.0;
}