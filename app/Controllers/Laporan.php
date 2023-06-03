<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\KategoriHelpdeskModel;
use App\Models\KategoriSuratModel;
use App\Models\SuratHistoryModel;
use App\Models\SuratModel;

class Laporan extends BaseController
{

    private $modelhelpdesk;
    private $modelkategorihelpdesk;
    private $modelsurathistory;
    private $modelsurat;
    private $title = 'Laporan';
    public function __construct()
    {
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelkategorihelpdesk = new KategoriHelpdeskModel();
        $this->modelsurathistory = new SuratHistoryModel();
        $this->modelsurat = new SuratModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title . ' Helpdesk',
            'helpdesk' => $this->modelhelpdesk->select('tb_helpdesk.*')->select('nama_lengkap')->select('nama_kategori')->select('nama_status')->join('tb_helpdesk_kategori', 'tb_helpdesk.id_kategori = tb_helpdesk_kategori.id_kategori')->join('tb_status', 'tb_status.id_status = tb_helpdesk.id_status')->join('tb_user', 'tb_user.id_user = tb_helpdesk.cid')->findAll()
        ];
        return view('laporan/helpdesk', $data);
    }

    public function history()
    {

        if (session()->get('id_role') == 4) {

            $getAll = $this->modelsurathistory->select('tb_surat_history.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat_history.cid')->join('tb_user as u', 'u.id_user = tb_surat_history.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat_history.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat_history.id_status')->orderBy('id_history', 'DESC')->where('tb_surat_kategori.is_out', 1)->where('tb_surat_history.cid', session()->get('id_user'))->findAll();
        } else {

            $getAll = $this->modelsurathistory->select('tb_surat_history.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat_history.cid')->join('tb_user as u', 'u.id_user = tb_surat_history.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat_history.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat_history.id_status')->orderBy('id_history', 'DESC')->where('tb_surat_kategori.is_out', 1)->findAll();
        }

        $data = [
            'title' => 'History Surat',
            'surat' => $getAll
        ];
        return view('laporan/history', $data);
    }

    public function masuk()
    {
        $data = [
            'title' => $this->title,
            'surat' => $this->modelsurat->select('tb_surat.*, nama_kategori, is_out')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->where('is_out', 0)->findAll()
        ];

        return view('laporan/masuk', $data);
    }
}
