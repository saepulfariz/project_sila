<?php


function createLog($data = [], $key = 0)
{
    $session = session();
    // $data = [];
    $res = [];
    if ($key == 0) {
        $res['cid'] = $session->get('id_user');
        // $res['uid'] = $session->get('id_user');
    } else {
        $res['uid'] = $session->get('id_user');
    }
    $data = array_merge($data, $res);
    return $data;
}

function calAge($date)
{
    $bday = new DateTime($date); // Your date of birth
    // $bday = new DateTime('11.4.1987'); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);
    // printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
    // printf("\n");

    return $diff->y;
}


function makeString($number)
{
    $string = '';
    for ($i = 0; $i < $number; $i++) {
        $string .= '*';
    }

    return $string;
}


function makeStringAnonymous($string, $start, $end)
{
    $string_start = substr($string, 0, $start);
    $count_string = strlen($string);
    $count_string_anony = $count_string - ($start + $end);
    $string_end = substr($string, $count_string - $end, $end);
    return $string_start . makeString($count_string_anony) . $string_end;
}


function cuplikKonten($konten, $maxKata = 20)
{
    // $maxKata = 20; //max kata dalam cuplikan artikel --> silahkan diganti sesuai kebutuhan
    $pecahArtikel = explode(' ', $konten); //pecah artikel menjadi array of string
    if (count($pecahArtikel) > $maxKata) {
        $cuplik = '';
        for ($a = 0; $a < $maxKata; $a++) {
            $cuplik .= $pecahArtikel[$a] . " ";
        }
        return "$cuplik..";
    } else {
        return $konten;
    }
}
