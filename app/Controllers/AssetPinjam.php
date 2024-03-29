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
    private $modelassetstatus;
    private $modeltransaksi;
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
        $this->modelassetstatus = new \App\Models\AssetStatusModel();
        $this->modeltransaksi = new \App\Models\AssetTransaksiModel();
    }

    public function index()
    {
        if (session()->get('id_role') == 4) {
            $result = $this->model->join('tb_user', 'tb_user.id_user = tb_asset_pinjam.cid')->join('tb_asset_pinjam_status', 'tb_asset_pinjam_status.id_status = tb_asset_pinjam.id_status')->orderBy('id_pinjam', 'DESC')->where('tb_asset_pinjam.cid', session()->get('id_user'))->findAll();
        } else {
            $result = $this->model->join('tb_user', 'tb_user.id_user = tb_asset_pinjam.cid')->join('tb_asset_pinjam_status', 'tb_asset_pinjam_status.id_status = tb_asset_pinjam.id_status')->orderBy('id_pinjam', 'DESC')->findAll();
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'data' => $result
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

        $check_edit = $this->model->where('kode_pinjam', $kode_pinjam)->first();
        if ($check_edit) {
            if ($check_edit['id_status'] != 2) {
                $result['error'] = true;
                $result['message'] = "Failed Add, Bukan PENDING";
                return json_encode($result);
            }
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

    public function returnOrderItemBarang()
    {
        $id = $this->request->getVar('id');
        $id_status = $this->request->getVar('id_status');

        $res = $this->modelpinjamtransaksi->find($id);
        if ($res) {
            $data = [
                'kode_pinjam' => $res['kode_pinjam'],
                'id_item' => $res['id_item'],
                'id_status' =>  $id_status
            ];
            $this->modelpinjamtransaksi->save($data);

            $result['error'] = false;
            $result['message'] = "Success Return";
        } else {
            $result['error'] = true;
            $result['message'] = "Not Found";
        }

        return json_encode($result);
    }

    public function returnUpdate($id = null)
    {
        $result = $this->model->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $data = [
            'catatan' => 'STAFF - ' . $result['catatan'] . ' || MAHASISWA - ' . $this->request->getVar('catatan'),
            'tgl_kembali' => date('Y-m-d'),
            'id_status' => 4, // kembali
        ];

        $data = createLog($data, 1);

        $pinjam = $this->modelassetstatus->like('nama_status', 'pinjam')->first()['id_status'];

        $data_return  = $this->modelpinjamtransaksi->where('id_status !=', $pinjam)->where('kode_pinjam', $result['kode_pinjam'])->findAll();
        foreach ($data_return as $d) {
            $id_status = ($d['id_status'] == 5) ? 1 : $d['id_status'];
            // jika kembali maka jadi ada status nya
            $data_update = [
                'id_status' => $id_status
            ];
            $this->modelitem->where('id_item', $d['id_item'])->update(null, $data_update);

            $data_transaksi = [
                'id_item' => $d['id_item'],
                'id_status' => $id_status,
                'deskripsi' => 'Return ' . $this->modelassetstatus->find($id_status)['nama_status'],
                'tgl_transaksi' => date('Y-m-d'),
                'id_penanggung_jawab' => session()->get('id_user'),
            ];
            $data_transaksi = createLog($data_transaksi, 0);
            $res = $this->modeltransaksi->save($data_transaksi);
        }


        $res = $this->model->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Return Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Return Failed');
        }
        return redirect()->to($this->link);
    }

    public function listItemOrderBarang()
    {
        $kode_pinjam = $this->request->getVar('kode_pinjam');
        $id_status = $this->request->getVar('id_status');
        $pinjam = $this->modelassetstatus->like('nama_status', 'pinjam')->first()['id_status'];

        $data = $this->modelpinjamtransaksi->join('tb_asset_item', 'tb_asset_item.id_item = tb_asset_pinjam_transaksi.id_item')->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->join('tb_asset_status', 'tb_asset_status.id_status = tb_asset_pinjam_transaksi.id_status')->where('kode_pinjam', $kode_pinjam);

        if ($id_status == 1) {
            // jika list di pinjam kan
            $data = $data->where('tb_asset_pinjam_transaksi.id_status', $pinjam);
        } else {
            // list yang mau di kembalikan
            $data = $data->where('tb_asset_pinjam_transaksi.id_status != ', $pinjam)->where('tb_asset_pinjam_transaksi.id_status != ', 1);
        }

        $data = $data->findAll();

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

        $data = $this->modelitem->join('tb_asset_barang', 'tb_asset_barang.id_barang = tb_asset_item.id_barang')->join('tb_asset_status', 'tb_asset_status.id_status = tb_asset_item.id_status')->where('tb_asset_item.id_barang', $id)->where('tb_asset_item.id_status', 1)->findAll();

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
        // $result = $this->model->find($id);
        $result = $this->model->where('kode_pinjam', $id)->first();
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'data' => $result,
            'status_id' => [
                'kembali' => $this->modelassetstatus->like('nama_status', 'kembali')->first()['id_status'],
                'rusak' => $this->modelassetstatus->like('nama_status', 'rusak')->first()['id_status'],
                'hilang' => $this->modelassetstatus->like('nama_status', 'hilang')->first()['id_status'],
            ],
            'status' => $this->modelstatus->findAll(),
            'barang' => $this->modelbarang->select('id_barang, nama_barang, (SELECT COUNT(id_item) as qty FROM tb_asset_item WHERE id_status = 1 AND id_barang = tb_asset_barang.id_barang) as qty')->findAll(),
        ];

        return view($this->view . '/show', $data);
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
            // 'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'perihal' => $this->request->getVar('perihal'),
            // 'catatan' => $this->request->getVar('catatan'),
            // 'id_status' => $this->request->getVar('id_status'),
            'id_status' => 2,
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
        $result = $this->model->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        if ($result['id_status'] != 2) {
            $this->alert->set('warning', 'Warning', 'NOT EDIT, BUKAN PENDING');
            return redirect()->to($this->link);
        }

        $data = [
            'kode_pinjam' => $this->request->getVar('kode_pinjam'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'jatuh_tempo' => $this->request->getVar('jatuh_tempo'),
            // 'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'perihal' => $this->request->getVar('perihal'),
            // 'catatan' => $this->request->getVar('catatan'),
            // 'id_status' => $this->request->getVar('id_status'),
        ];

        if ((session()->get('id_role') != 4) && (session()->get('id_role') != 3)) {
            $data['catatan'] = $this->request->getVar('catatan');
            $data['id_status'] = $this->request->getVar('id_status');
        }

        $data = createLog($data, 1);

        if (session()->get('id_role') != 4) {
            $data_pinjam = $this->modelpinjamtransaksi->where('kode_pinjam', $data['kode_pinjam'])->findAll();
            foreach ($data_pinjam as $d) {
                $data_update = [
                    'id_status' => $d['id_status']
                ];
                $this->modelitem->where('id_item', $d['id_item'])->update(null, $data_update);

                $data_transaksi = [
                    'id_item' => $d['id_item'],
                    'id_status' => $d['id_status'],
                    'deskripsi' => 'Transaksi : ' . $this->modelassetstatus->find($d['id_status'])['nama_status'],
                    'tgl_transaksi' => date('Y-m-d'),
                    'id_penanggung_jawab' => session()->get('id_user'),
                ];
                $data_transaksi = createLog($data_transaksi, 0);
                $res = $this->modeltransaksi->save($data_transaksi);
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

        if ($result['id_status'] != 2) {
            $this->alert->set('warning', 'Warning', 'NOT DELETE, BUKAN PENDINg');
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
