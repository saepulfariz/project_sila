<?php


function createLog($data = [], $key = 0)
{
    $session = session();
    // $data = [];
    $res = [];
    if ($key == 0) {
        $res['cid'] = $session->get('id_user');
        $res['uid'] = $session->get('id_user');
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
