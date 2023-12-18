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


function autonumber($id_terakhir, $panjang_kode, $panjang_angka)
{

    // mengambil nilai kode ex: KNS0015 hasil KNS
    $kode = substr($id_terakhir, 0, $panjang_kode);

    // mengambil nilai angka
    // ex: KNS0015 hasilnya 0015
    $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);

    // menambahkan nilai angka dengan 1
    // kemudian memberikan string 0 agar panjang string angka menjadi 4
    // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
    // sehingga menjadi 0006
    $angka_baru = str_repeat("0", $panjang_angka - strlen($angka + 1)) . ($angka + 1);

    // menggabungkan kode dengan nilang angka baru
    $id_baru = $kode . $angka_baru;

    return $id_baru;
}

function autonumberDate($id_terakhir, $panjang_kode, $panjang_angka)
{

    // mengambil nilai kode ex: KNS0015 hasil KNS
    $kode = substr($id_terakhir, 0, $panjang_kode);

    // panjang kode
    $lengthKode = strlen($id_terakhir);
    $dateAdd = "";
    if ($lengthKode == $panjang_angka + $panjang_kode) {
        $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
        $angka_baru = str_repeat("0", $panjang_angka - strlen($angka + 1)) . ($angka + 1);
    } else {

        $panjang_date = $lengthKode - $panjang_angka - $panjang_kode;
        $getDate = substr($id_terakhir, $panjang_kode, $panjang_date);
        $dateNow = date('ymd');

        // mengambil nilai angka
        // ex: KNS0015 hasilnya 0015
        // jika date nya sama maka kita auto increment jika beda kita reset ke 0000
        if ($dateNow == $getDate) {
            $dateAdd = $getDate;
            $angka = substr($id_terakhir, $panjang_kode + $panjang_date, $panjang_angka);

            // menambahkan nilai angka dengan 1
            // kemudian memberikan string 0 agar panjang string angka menjadi 4
            // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
            // sehingga menjadi 0006
            $angka_baru = str_repeat("0", $panjang_angka - strlen($angka + 1)) . ($angka + 1);
        } else {
            $dateAdd = $dateNow;
            $angka_baru = str_repeat('0', $panjang_angka);
        }
    }


    // menggabungkan kode dengan nilang angka baru
    $id_baru = $kode . $dateAdd . $angka_baru;

    return $id_baru;
}
