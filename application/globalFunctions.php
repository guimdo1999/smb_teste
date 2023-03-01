<?php
function convertDate($date)
{ //Arrumando a data que vem do datapicker
    $data1 = substr($date, 0, 2);
    $data2 = substr($date, 3, 2);
    $data3 = substr($date, 6, 4);
    $date = $data2 . "/" . $data1 . "/" . $data3;
    return $date;
}
function maskTel($telefone)
{
    $telefoneFormatado = preg_replace('/[^0-9]/', '', $telefone);
    $combina = [];
    preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $telefoneFormatado, $combina);
    if ($combina) {
        return '(' . $combina[1] . ') ' . $combina[2] . '-' . $combina[3];
    }

    return $telefone;
}
