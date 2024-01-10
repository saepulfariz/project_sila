<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HelpdeskModel;
use App\Models\KategoriSuratModel;

class Front extends BaseController
{
    private $modelkategorisurat;
    private $modelhelpdesk;
    private $modelassetkategori;
    private $modelassetbarang;
    private $modelassetitem;
    public function __construct()
    {
        $this->modelkategorisurat = new KategoriSuratModel();
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelassetkategori = new \App\Models\AssetKategoriModel();
        $this->modelassetbarang = new \App\Models\AssetBarangModel();
        $this->modelassetitem = new \App\Models\AssetItemModel();
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

    public function helpdesk()
    {
        $data = [
            'title' => 'Helpdesk',
            'helpdesk' => $this->modelhelpdesk->select('tb_helpdesk.created_at as created_at, tb_helpdesk.deskripsi, tb_status.id_status, nama_status, nama_lengkap')->join('tb_status', 'tb_status.id_status = tb_helpdesk.id_status', 'left')->join('tb_user', 'tb_user.id_user = tb_helpdesk.cid', 'left')->findAll(),
        ];

        return view('front/helpdesk', $data);
    }

    public function asset()
    {
        $kategori = $this->modelassetkategori->select('id_kategori, nama_kategori')->findAll();
        $array = [];
        $a = 0;
        foreach ($kategori as $d) {
            $array[$a] = $d;
            $array[$a]['jumlah'] = $this->modelassetitem->select('count(id_item) as jumlah')->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->where('id_status', 1)->where('id_kategori', $d['id_kategori'])->first()['jumlah'];
            $array[$a]['barang'] = $this->modelassetbarang->where('id_kategori', $d['id_kategori'])->findAll();
            $a++;
        }

        $data = [
            'title' => 'Asset',
            'kategori' => $array
        ];


        return view('front/asset', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
        ];

        return view('front/about', $data);
    }
}
