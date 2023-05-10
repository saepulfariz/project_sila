<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\KategoriHelpdeskModel;
use App\Models\SuratModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    private $modeluser;
    private $modelhelpdesk;
    private $modelkategorihelpdesk;
    private $modelsurat;
    public function __construct()
    {
        $this->modeluser = new UserModel();
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelsurat = new SuratModel();
        $this->modelkategorihelpdesk = new KategoriHelpdeskModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        if (session()->get('id_role') == 4) {
            return view('dashboard/mahasiswa', $data);
        } else {
            $data['count_user'] = count($this->modeluser->findAll());
            $data['count_helpdesk'] = $this->modelhelpdesk->select('COUNT(id_helpdesk) as count')->first()['count'];
            $data['count_masuk'] = $this->modelsurat->select('COUNT(id_surat) as count')->join('tb_surat_kategori', 'tb_surat.id_kategori = tb_surat_kategori.id_kategori', 'left')->where('tb_surat_kategori.is_out', 0)->first()['count'];
            $data['count_keluar'] = $this->modelsurat->select('COUNT(id_surat) as count')->join('tb_surat_kategori', 'tb_surat.id_kategori = tb_surat_kategori.id_kategori', 'left')->where('tb_surat_kategori.is_out', 1)->first()['count'];
            $data['helpdesk'] = $this->modelkategorihelpdesk->findAll();
            return view('dashboard/admin', $data);
        }
    }
}
