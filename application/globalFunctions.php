<?php
function convertDate($date)
{ //Arrumando a data que vem do datapicker
    $data1 = substr($date, 0, 2);
    $data2 = substr($date, 3, 2);
    $data3 = substr($date, 6, 4);
    $date = $data2 . "/" . $data1 . "/" . $data3;
    return $date;
}


