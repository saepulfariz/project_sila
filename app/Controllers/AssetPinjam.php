<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AssetPinjam extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    private $model;
    private $modelstatus;
    private $modelbarang;
    private $modelpinjamdetail;
    private $link = 'asset/pinjam/list';
    private $view = 'asset/pinjam/list';
    private $title = 'Asset Pinjam';
    public function __construct()
    {
        $this->model = new \App\Models\AssetPinjamModel();
        $this->modelstatus = new \App\Models\AssetPinjamStatusModel();
        $this->modelbarang = new \App\Models\AssetBarangModel();
        $this->modelpinjamdetail = new \App\Models\AssetPinjamDetailModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'data' => $this->model->findAll()
        ];

        return view($this->view . '/index', $data);
    }

    public function listBarang()
    {
        $id_pinjam = $this->model->orderBy('id_pinjam', 'DESC')->limit(1)->first();
        $id_pinjam = ($id_pinjam) ? $id_pinjam['id_pinjam'] + 1 : 1;
        $id_pinjam = $id_pinjam;
        $result['error'] = false;
        $result['data'] = $this->modelpinjamdetail->select('id, qty, nama_barang')->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_pinjam_detail.id_barang')->where('id_pinjam', $id_pinjam)->findAll();
        return json_encode($result);
    }

    public function addBarang()
    {
        $id_pinjam = $this->model->orderBy('id_pinjam', 'DESC')->limit(1)->first();
        $id_pinjam = ($id_pinjam) ? $id_pinjam['id_pinjam'] + 1 : 1;
        $data = [
            'id_pinjam' => $id_pinjam,
            'id_barang' => $this->request->getVar('id_barang'),
            'qty' => $this->request->getVar('qty'),
        ];

        $this->modelpinjamdetail->save($data);

        $result['error'] = false;
        $result['message'] = "Success Add";
        return json_encode($result);
    }

    public function deleteBarang()
    {
        $id = $this->request->getVar('id');

        $this->modelpinjamdetail->delete($id);

        $result['error'] = false;
        $result['message'] = "Delete Add";
        return json_encode($result);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
            'status' => $this->modelstatus->findAll(),
            'barang' => $this->modelbarang->select('id_barang, nama_barang, (SELECT COUNT(id_item) as qty FROM tb_asset_item WHERE id_status = 1 AND id_barang = tb_asset_barang.id_barang) as qty')->findAll(),
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
            'nama_status' => $this->request->getVar('nama_status')
        ];

        $res = $this->model->save($data);
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
        $result = $this->model->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
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
            'nama_status' => $this->request->getVar('nama_status')
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
