<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\KategoriHelpdeskModel;

class Laporan extends BaseController
{

    private $modelhelpdesk;
    private $modelkategorihelpdesk;
    private $title = 'Laporan';
    public function __construct()
    {
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelkategorihelpdesk = new KategoriHelpdeskModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title . ' Helpdesk',
            'helpdesk' => $this->modelhelpdesk->select('tb_helpdesk.*')->select('nama_lengkap')->select('nama_kategori')->select('nama_status')->join('tb_helpdesk_kategori', 'tb_helpdesk.id_kategori = tb_helpdesk_kategori.id_kategori')->join('tb_status', 'tb_status.id_status = tb_helpdesk.id_status')->join('tb_user', 'tb_user.id_user = tb_helpdesk.cid')->findAll()
        ];
        return view('laporan/helpdesk', $data);
    }
}
