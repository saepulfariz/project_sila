<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\KategoriSuratModel;

class Front extends BaseController
{
    private $modelkategorisurat;
    private $modelhelpdesk;
    public function __construct()
    {
        $this->modelkategorisurat = new KategoriSuratModel();
        $this->modelhelpdesk = new HelpdeskModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Welcome',
            'kategori_surat' => $this->modelkategorisurat->where('is_out', 1)->findAll(),
            'helpdesk' => $this->modelhelpdesk->select('tb_helpdesk.created_at as created_at, tb_helpdesk.deskripsi, tb_status.id_status, nama_status, nama_lengkap')->join('tb_status', 'tb_status.id_status = tb_helpdesk.id_status', 'left')->join('tb_user', 'tb_user.id_user = tb_helpdesk.cid', 'left')->findAll(),
        ];

        return view('front/index', $data);
    }
}
