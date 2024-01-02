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
    private $modelitem;
    private $modelpinjamtransaksi;
    private $link = 'asset/pinjam/list';
    private $view = 'asset/pinjam/list';
    private $title = 'Asset Pinjam';
    public function __construct()
    {
        $this->model = new \App\Models\AssetPinjamModel();
        $this->modelstatus = new \App\Models\AssetPinjamStatusModel();
        $this->modelbarang = new \App\Models\AssetBarangModel();
        $this->modelpinjamdetail = new \App\Models\AssetPinjamDetailModel();
        $this->modelitem = new \App\Models\AssetItemModel();
        $this->modelpinjamtransaksi = new \App\Models\AssetPinjamTransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'data' => $this->model->join('tb_user', 'tb_user.id_user = tb_asset_pinjam.cid')->join('tb_asset_pinjam_status', 'tb_asset_pinjam_status.id_status = tb_asset_pinjam.id_status')->orderBy('id_pinjam', 'DESC')->findAll()
        ];

        return view($this->view . '/index', $data);
    }

    public function listBarang()
    {
        $get_kode = $this->request->getVar('kode_pinjam');
        if ($get_kode) {
            $kode_pinjam =  $get_kode;
        } else {
            $kode_pinjam = $this->model->orderBy('id_pinjam', 'DESC')->limit(1)->first();
            $date = date('ymd');
            $kode_pinjam = ($kode_pinjam) ? $kode_pinjam['kode_pinjam'] : 'PJ' . $date . '0000';
            $kode_pinjam = autonumberDate($kode_pinjam, 2, 4);
        }

        $result['error'] = false;
        $result['data'] = $this->modelpinjamdetail->select('id, qty, nama_barang, tb_asset_pinjam_detail.id_barang')->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_pinjam_detail.id_barang')->where('kode_pinjam', $kode_pinjam)->findAll();
        return json_encode($result);
    }

    public function addBarang()
    {
        $get_kode = $this->request->getVar('kode_pinjam');
        if ($get_kode) {
            $kode_pinjam =  $get_kode;
        } else {
            $kode_pinjam = $this->model->orderBy('id_pinjam', 'DESC')->limit(1)->first();
            $date = date('ymd');
            $kode_pinjam = ($kode_pinjam) ? $kode_pinjam['kode_pinjam'] : 'PJ' . $date . '0000';
            $kode_pinjam = autonumberDate($kode_pinjam, 2, 4);
        }

        $data = [
            'kode_pinjam' => $kode_pinjam,
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
        $result['message'] = "Success Delete";
        return json_encode($result);
    }

    public function addOrderItemBarang()
    {
        $kode_pinjam = $this->request->getVar('kode_pinjam');
        $id_item = $this->request->getVar('id_item');

        $data = [
            'kode_pinjam' => $kode_pinjam,
            'id_item' => $id_item,
            'id_status' =>  3, // pinjam
        ];

        $data = createLog($data, 0);
        $this->modelpinjamtransaksi->save($data);
        $result['error'] = false;
        $result['message'] = "Success Add";
        return json_encode($result);
    }

    public function deleteOrderItemBarang()
    {
        $id = $this->request->getVar('id');

        $this->modelpinjamtransaksi->delete($id);

        $result['error'] = false;
        $result['message'] = "Success Delete";
        return json_encode($result);
    }

    public function listItemOrderBarang()
    {
        $kode_pinjam = $this->request->getVar('kode_pinjam');

        $data = $this->modelpinjamtransaksi->join('tb_asset_item', 'tb_asset_item.id_item = tb_asset_pinjam_transaksi.id_item')->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->join('tb_asset_status', 'tb_asset_status.id_status = tb_asset_pinjam_transaksi.id_status')->where('kode_pinjam', $kode_pinjam)->findAll();

        if ($data) {
            $result['error'] = false;
            $result['message'] = "result data";
            $result['data'] = $data;
        } else {
            $result['error'] = true;
            $result['message'] = "Not Found";
        }

        return json_encode($result);
    }

    public function listItemBarang()
    {
        $id = $this->request->getVar('id');

        $data = $this->modelitem->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->join('tb_asset_status', 'tb_asset_status.id_status = tb_asset_item.id_status')->where('tb_asset_item.id_barang', $id)->where('id_status', 1)->findAll();

        if ($data) {
            $result['error'] = false;
            $result['message'] = "result data";
            $result['data'] = $data;
        } else {
            $result['error'] = true;
            $result['message'] = "Not Found";
        }

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
        $kode_pinjam = $this->model->orderBy('id_pinjam', 'DESC')->limit(1)->first();
        $date = date('ymd');
        $kode_pinjam = ($kode_pinjam) ? $kode_pinjam['kode_pinjam'] : 'PJ' . $date . '0000';
        $kode_pinjam = autonumberDate($kode_pinjam, 2, 4);

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'kode_pinjam' => $kode_pinjam,
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
            'kode_pinjam' => $this->request->getVar('kode_pinjam'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'jatuh_tempo' => $this->request->getVar('jatuh_tempo'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'perihal' => $this->request->getVar('perihal'),
            'catatan' => $this->request->getVar('catatan'),
            'id_status' => $this->request->getVar('id_status'),
        ];

        $data = createLog($data, 0);
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
            'data' => $result,
            'status' => $this->modelstatus->findAll(),
            'barang' => $this->modelbarang->select('id_barang, nama_barang, (SELECT COUNT(id_item) as qty FROM tb_asset_item WHERE id_status = 1 AND id_barang = tb_asset_barang.id_barang) as qty')->findAll(),
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
            'kode_pinjam' => $this->request->getVar('kode_pinjam'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'jatuh_tempo' => $this->request->getVar('jatuh_tempo'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'perihal' => $this->request->getVar('perihal'),
            'catatan' => $this->request->getVar('catatan'),
            'id_status' => $this->request->getVar('id_status'),
        ];

        $data = createLog($data, 1);

        if (session()->get('id_role') != 4) {
            $data_pinjam = $this->modelpinjamtransaksi->where('kode_pinjam', $data['kode_pinjam'])->findAll();
            foreach ($data_pinjam as $d) {
                $data_update = [
                    'id_status' => $d['id_status']
                ];
                $this->modelitem->where('id_item', $d['id_item'])->update(null, $data_update);
            }
        }

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

        $this->modelpinjamdetail->where('kode_pinjam', $result['kode_pinjam'])->delete();

        $res = $this->model->delete($id);
        if ($res) {
            $this->alert->set('success', 'Success', 'Delete Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Delete Failed');
        }
        return redirect()->to($this->link);
    }
}
