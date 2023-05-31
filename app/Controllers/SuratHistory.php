<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratHistoryModel;

class SuratHistory extends BaseController
{
    private $modelsurathistory;
    public function __construct()
    {
        $this->modelsurathistory = new SuratHistoryModel();
    }

    public function index()
    {
        $getAll = $this->modelsurathistory->select('tb_surat_history.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat_history.cid')->join('tb_user as u', 'u.id_user = tb_surat_history.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat_history.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat_history.id_status')->orderBy('id_history', 'DESC')->where('tb_surat_kategori.is_out', 1)->findAll();

        $data = [
            'title' => 'History Surat',
            'surat' => $getAll
        ];
        return view('surat/history/index', $data);
    }
}
