<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\KategoriHelpdeskModel;
use App\Models\KategoriSuratModel;
use App\Models\SuratModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    private $modeluser;
    private $modelhelpdesk;
    private $modelkategorihelpdesk;
    private $modelsurat;
    private $modelsuratkategori;
    public function __construct()
    {
        $this->modeluser = new UserModel();
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelsurat = new SuratModel();
        $this->modelkategorihelpdesk = new KategoriHelpdeskModel();
        $this->modelsuratkategori = new KategoriSuratModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        if (session()->get('id_role') == 4) {
            $data['helpdesk_pending'] = $this->modelhelpdesk->select('COUNT(id_helpdesk) AS count')->where('id_status', 1)->where('cid', session()->get('id_user'))->first()['count'];
            $data['helpdesk_done'] = $this->modelhelpdesk->select('COUNT(id_helpdesk) AS count')->where('id_status', 2)->where('cid', session()->get('id_user'))->first()['count'];
            $data['surat_pending'] = $this->modelsurat->select('COUNT(id_surat) AS count')->where('id_status', 1)->where('cid', session()->get('id_user'))->first()['count'];
            $data['surat_done'] = $this->modelsurat->select('COUNT(id_surat) AS count')->where('id_status', 2)->where('cid', session()->get('id_user'))->first()['count'];
            return view('dashboard/mahasiswa', $data);
        } else {
            $sub_chart = "( SELECT COUNT(id_helpdesk) AS COUNT FROM tb_helpdesk WHERE id_kategori = tb_helpdesk_kategori.id_kategori) AS count";
            $data['chart'] = $this->modelkategorihelpdesk->select('nama_kategori')->select($sub_chart)->findAll();
            $data['count_user'] = count($this->modeluser->findAll());
            $data['count_helpdesk'] = $this->modelhelpdesk->select('COUNT(id_helpdesk) as count')->first()['count'];
            $data['count_masuk'] = $this->modelsurat->select('COUNT(id_surat) as count')->join('tb_surat_kategori', 'tb_surat.id_kategori = tb_surat_kategori.id_kategori', 'left')->where('tb_surat_kategori.is_out', 0)->first()['count'];
            $data['count_keluar'] = $this->modelsurat->select('COUNT(id_surat) as count')->join('tb_surat_kategori', 'tb_surat.id_kategori = tb_surat_kategori.id_kategori', 'left')->where('tb_surat_kategori.is_out', 1)->first()['count'];
            $data['helpdesk'] = $this->modelkategorihelpdesk->findAll();
            $sub_query = "(SELECT COUNT(id_surat) AS jm FROM tb_surat WHERE id_kategori = tb_surat_kategori.id_kategori ) AS count ";
            $data['surat'] = $this->modelsuratkategori->select('nama_kategori')->select($sub_query)->findAll();
            return view('dashboard/admin', $data);
        }
    }
}
