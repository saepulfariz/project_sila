<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AssetItem extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    private $model;
    private $modelbarang;
    private $modelstatus;
    private $modelkategori;
    private $modeltransaksi;
    private $modeluser;
    private $link = 'asset/item';
    private $view = 'asset/item';
    private $title = 'Asset Item';
    public function __construct()
    {
        $this->model = new \App\Models\AssetItemModel();
        $this->modelbarang = new \App\Models\AssetBarangModel();
        $this->modelstatus = new \App\Models\AssetStatusModel();
        $this->modelkategori = new \App\Models\AssetKategoriModel();
        $this->modeltransaksi = new \App\Models\AssetTransaksiModel();
        $this->modeluser = new \App\Models\UserModel();
    }

    public function log()
    {
        $data = [
            'title' => 'Log ' . $this->title,
            'link' => 'asset/log',
            'data' => $this->modeltransaksi->select('tb_asset_transaksi.id, kode_item, nama_barang, nama_status, deskripsi, pc.nama_lengkap as pencatat, pj.nama_lengkap as  penanggung_jawab, tgl_transaksi')->join('tb_asset_item', 'tb_asset_item.id_item = tb_asset_transaksi.id_item')->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->join('tb_asset_kategori', 'tb_asset_kategori.id_kategori = tb_asset_barang.id_kategori')->join('tb_asset_status', 'tb_asset_status.id_status = tb_asset_transaksi.id_status')->join('tb_user as pj', 'pj.id_user = tb_asset_transaksi.id_penanggung_jawab')->join('tb_user as pc', 'pc.id_user = tb_asset_transaksi.cid')->orderBy('id', 'DESC')->findAll()
        ];

        return view('asset/log/index', $data);
    }

    public function logNew()
    {
        $data = [
            'title' => 'New Log ' . $this->title,
            'link' => 'asset/log',
            'item' => $this->model->select('id_item,kode_item, nama_barang')->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->findAll(),
            'user' => $this->modeluser->findAll(),
            'status' => $this->modelstatus->findAll(),
        ];

        return view('asset/log/new', $data);
    }

    public function logCreate()
    {
        $data = [
            'id_item' => $this->request->getVar('id_item'),
            'id_status' => $this->request->getVar('id_status'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tgl_transaksi' => date('Y-m-d'),
            'id_penanggung_jawab' => $this->request->getVar('id_penanggung_jawab'),
        ];
        $data = createLog($data, 0);
        $res = $this->modeltransaksi->save($data);
        // update status asset item
        $data_item = [
            'id_status' => $data['id_status'],
        ];
        $this->model->where('id_item', $data['id_item'])->update(null, $data_item);
        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to('asset/log');
    }

    public function ajaxLogItem($id)
    {
        $item = $this->model->select('id_item, kode_item, id_status')->find($id);

        if (!$item) {
            $data = [
                'error' => true,
                'message' => 'not found'
            ];
            return json_encode($data);
        }


        $data = [
            'error' => false,
            'data' => $item
        ];
        return json_encode($data);
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'data' => $this->model->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->join('tb_asset_kategori', 'tb_asset_kategori.id_kategori = tb_asset_barang.id_kategori')->join('tb_asset_status', 'tb_asset_status.id_status = tb_asset_item.id_status')->orderBy('id_item', 'DESC')->findAll()
        ];

        return view($this->view . '/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id_barang = null)
    {
        $kode_barang = $this->modelbarang->find($id_barang);

        if (!$kode_barang) {
            $data = [
                'error' => true,
                'message' => 'not found'
            ];
            return json_encode($data);
        }

        // GET kode_item berdasarkan
        $result = $this->model->where('id_barang', $id_barang)->orderBy('id_item', 'DESC')->first();

        $kode_barang = $kode_barang['kode_barang'];

        // get date
        $date = date('ymd');

        if (!$result) {
            $kode_item = $kode_barang . $date . '0000';
        } else {
            $kode_item = $result['kode_item'];
        }

        $data = [
            'error' => true,
            'data' => autonumberDate($kode_item, strlen($kode_barang), 4)
        ];
        return json_encode($data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'barang' => $this->modelbarang->findAll(),
            'status' => $this->modelstatus->findAll(),
        ];

        return view($this->view . '/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'kode_item' => $this->request->getVar('kode_item'),
            'id_barang' => $this->request->getVar('id_barang'),
            'id_status' => 1,
        ];

        $res = $this->model->save($data);
        $lastId = $this->model->orderBy('id_item', 'DESC')->first()['id_item'];
        $data_transaksi = [
            'id_item' => $lastId,
            'tgl_transaksi' => date('Y-m-d'),
            'id_status' => $data['id_status'],
            'deskripsi' => 'add item',
            'id_penanggung_jawab' => session()->get('id_user'),
        ];

        $data_transaksi = createLog($data_transaksi, 0);
        $this->modeltransaksi->save($data_transaksi);


        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to($this->link);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $result = $this->model->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'barang' => $this->modelbarang->findAll(),
            'status' => $this->modelstatus->findAll(),
            'data' => $result
        ];

        return view($this->view . '/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = [
            // 'kode_item' => $this->request->getVar('kode_item'),
            // 'id_barang' => $this->request->getVar('id_barang'),
            'id_status' => $this->request->getVar('id_status'),
        ];

        $res = $this->model->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Update Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Update Failed');
        }
        return redirect()->to($this->link);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $result = $this->model->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $res = $this->model->delete($id);
        if ($res) {
            $this->alert->set('success', 'Success', 'Delete Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Delete Failed');
        }
        return redirect()->to($this->link);
    }
}
