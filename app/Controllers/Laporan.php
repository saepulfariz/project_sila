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
    private $modelassetpinjam;
    private $title = 'Laporan';
    public function __construct()
    {
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelkategorihelpdesk = new KategoriHelpdeskModel();
        $this->modelsurathistory = new SuratHistoryModel();
        $this->modelsurat = new SuratModel();
        $this->modelassetpinjam = new \App\Models\AssetPinjamModel();
    }

    public function index()
    {
        $start = (htmlspecialchars($this->request->getVar('start'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('start'), true);
        $end = (htmlspecialchars($this->request->getVar('end'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('end'), true);
        $data = [
            'title' => $this->title . ' Helpdesk',
            'start' => $start,
            'end' => $end,
            'helpdesk' => $this->modelhelpdesk->select('tb_helpdesk.*')->select('nama_lengkap')->select('nama_kategori')->select('nama_status')->join('tb_helpdesk_kategori', 'tb_helpdesk.id_kategori = tb_helpdesk_kategori.id_kategori')->join('tb_status', 'tb_status.id_status = tb_helpdesk.id_status')->join('tb_user', 'tb_user.id_user = tb_helpdesk.cid')->where('CONVERT(tb_helpdesk.created_at, DATE) >=', $start)->where('CONVERT(tb_helpdesk.created_at, DATE) <=', $end)->findAll()
        ];
        return view('laporan/helpdesk', $data);
    }

    public function history()
    {

        $start = (htmlspecialchars($this->request->getVar('start'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('start'), true);
        $end = (htmlspecialchars($this->request->getVar('end'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('end'), true);

        if (session()->get('id_role') == 4) {

            $getAll = $this->modelsurathistory->select('tb_surat_history.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat_history.cid')->join('tb_user as u', 'u.id_user = tb_surat_history.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat_history.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat_history.id_status')->orderBy('id_history', 'DESC')->where('tb_surat_kategori.is_out', 1)->where('tb_surat_history.cid', session()->get('id_user'))->where('CONVERT(tb_surat_history.created_at, DATE) >=', $start)->where('CONVERT(tb_surat_history.created_at, DATE) <=', $end)->findAll();
        } else {

            $getAll = $this->modelsurathistory->select('tb_surat_history.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat_history.cid')->join('tb_user as u', 'u.id_user = tb_surat_history.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat_history.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat_history.id_status')->orderBy('id_history', 'DESC')->where('tb_surat_kategori.is_out', 1)->where('CONVERT(tb_surat_history.created_at, DATE) >=', $start)->where('CONVERT(tb_surat_history.created_at, DATE) <=', $end)->findAll();
        }

        $data = [
            'title' => 'History Surat',
            'surat' => $getAll,
            'start' => $start,
            'end' => $end
        ];
        return view('laporan/history', $data);
    }

    public function masuk()
    {
        $start = (htmlspecialchars($this->request->getVar('start'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('start'), true);
        $end = (htmlspecialchars($this->request->getVar('end'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('end'), true);
        $data = [
            'title' => $this->title,
            'surat' => $this->modelsurat->select('tb_surat.*, nama_kategori, is_out')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->where('is_out', 0)->where('CONVERT(tb_surat.created_at, DATE) >=', $start)->where('CONVERT(tb_surat.created_at, DATE) <=', $end)->findAll(),
            'start' => $start,
            'end' => $end
        ];

        return view('laporan/masuk', $data);
    }

    public function keluar()
    {

        $start = (htmlspecialchars($this->request->getVar('start'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('start'), true);
        $end = (htmlspecialchars($this->request->getVar('end'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('end'), true);

        if (session()->get('id_role') == 1 || session()->get('id_role') == 2 || session()->get('id_role') == 3) {
            $getAll = $this->modelsurat->select('tb_surat.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat.cid')->join('tb_user as u', 'u.id_user = tb_surat.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat.id_status')->orderBy('id_surat', 'DESC')->where('tb_surat_kategori.is_out', 1)->where('CONVERT(tb_surat.created_at, DATE) >=', $start)->where('CONVERT(tb_surat.created_at, DATE) <=', $end)->findAll();
        } else {
            $getAll = $this->modelsurat->select('tb_surat.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat.cid')->join('tb_user as u', 'u.id_user = tb_surat.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat.id_status')->where('tb_surat.cid', session()->get('id_user'))->orderBy('id_surat', 'DESC')->where('tb_surat_kategori.is_out', 1)->where('CONVERT(tb_surat.created_at, DATE) >=', $start)->where('CONVERT(tb_surat.created_at, DATE) <=', $end)->findAll();
        }

        $data = [
            'title' => $this->title,
            'surat' => $getAll,
            'start' => $start,
            'end' => $end
        ];

        return view('laporan/keluar', $data);
    }

    public function assetPinjam()
    {
        $start = (htmlspecialchars($this->request->getVar('start'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('start'), true);
        $end = (htmlspecialchars($this->request->getVar('end'), true) == '') ? date('Y-m-d') : htmlspecialchars($this->request->getVar('end'), true);

        if (session()->get('id_role') == 4) {
            $result = $this->modelassetpinjam->join('tb_user', 'tb_user.id_user = tb_asset_pinjam.cid')->join('tb_asset_pinjam_status', 'tb_asset_pinjam_status.id_status = tb_asset_pinjam.id_status')->orderBy('id_pinjam', 'DESC')->where('tb_asset_pinjam.cid', session()->get('id_user'))->where('CONVERT(tb_asset_pinjam.tgl_pinjam, DATE) >=', $start)->where('CONVERT(tb_asset_pinjam.tgl_pinjam, DATE) <=', $end)->findAll();
        } else {
            $result = $this->modelassetpinjam->join('tb_user', 'tb_user.id_user = tb_asset_pinjam.cid')->join('tb_asset_pinjam_status', 'tb_asset_pinjam_status.id_status = tb_asset_pinjam.id_status')->orderBy('id_pinjam', 'DESC')->where('CONVERT(tb_asset_pinjam.tgl_pinjam, DATE) >=', $start)->where('CONVERT(tb_asset_pinjam.tgl_pinjam, DATE) <=', $end)->findAll();
        }

        $data = [
            'title' => $this->title,
            'link' => 'laporan/asset_pinjam',
            'data' => $result,
            'start' => $start,
            'end' => $end
        ];

        return view('laporan/asset_pinjam', $data);
    }

    public function assetPinjamDetail($id = null)
    {
        // $result = $this->model->find($id);
        $result = $this->modelassetpinjam->join('tb_asset_pinjam_status', 'tb_asset_pinjam_status.id_status = tb_asset_pinjam.id_status')->where('kode_pinjam', $id)->first();
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('laporan/asset_pinjam');
        }

        $data = [
            'title' => $this->title,
            'link' => 'asset/pinjam/list',
            'data' => $result,
        ];

        return view('laporan/asset_pinjam_detail', $data);
    }
}
