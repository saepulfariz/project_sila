<?php

namespace App\Controllers;

use App\Models\KategoriSuratModel;
use App\Models\SuratModel;
use CodeIgniter\RESTful\ResourceController;

class SuratKeluar extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */


    private $modelsurat;
    private $modelkategorisurat;
    private $title = "Surat Keluar";
    public function __construct()
    {
        $this->modelkategorisurat = new KategoriSuratModel();
        $this->modelsurat = new SuratModel();
    }


    public function index()
    {
        $getAll = $this->modelsurat->select('tb_surat.*, is_out, nama_kategori, nama_status, username as pemohon')->join('tb_user', 'tb_user.id_user = tb_surat.cid')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat.id_status')->where('tb_surat.cid', session()->get('id_user'))->findAll();

        if (session()->get('id_role') == 1 || session()->get('id_role') == 2 || session()->get('id_role') == 3) {
            $getAll = $this->modelsurat->select('tb_surat.*, is_out, nama_kategori, nama_status, username as pemohon')->join('tb_user', 'tb_user.id_user = tb_surat.cid')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat.id_status')->findAll();
        }

        $data = [
            'title' => $this->title,
            'surat' => $getAll
        ];

        return view('surat/keluar/index', $data);
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
            'kategori' => $this->modelkategorisurat->where('is_out', 1)->findAll(),
        ];

        return view('surat/keluar/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'id_kategori' => htmlspecialchars($this->request->getVar('id_kategori'), true),
            'nama_surat' => htmlspecialchars($this->request->getVar('nama_surat'), true),
            'id_user' => session()->get('id_user'),
            'no_surat' => '',
            'file_surat' => '',
            'id_status' => 1,
        ];

        $data = createLog($data, 0);
        $res = $this->modelsurat->save($data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to('surat/keluar');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $result = $this->modelsurat->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('surat/keluar');
        }

        $cekUser = $this->modelsurat->where('cid', session()->get('id_user'))->where('id_surat', $id)->first();
        if (!$cekUser) {
            $this->alert->set('warning', 'Warning', 'Bukan bukan punya kamu');
            return redirect()->to('surat/keluar');
        }

        $cekStatus = $this->modelsurat->where('id_status != ', 1)->where('id_surat', $id)->first();
        if ($cekStatus) {
            $this->alert->set('warning', 'Warning', 'Gak Bisa Di Edit Karena status bukan pending');
            return redirect()->to('surat/keluar');
        }

        $data = [
            'title' => $this->title,
            'surat' => $result,
            'kategori' => $this->modelkategorisurat->where('is_out', 1)->findAll(),
        ];

        return view('surat/keluar/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $result = $this->modelsurat->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('surat/keluar');
        }

        $cekUser = $this->modelsurat->where('cid', session()->get('id_user'))->where('id_surat', $id)->first();
        if (!$cekUser) {
            $this->alert->set('warning', 'Warning', 'Bukan bukan punya kamu');
            return redirect()->to('surat/keluar');
        }

        $cekStatus = $this->modelsurat->where('id_status != ', 1)->where('id_surat', $id)->first();
        if ($cekStatus) {
            $this->alert->set('warning', 'Warning', 'Gak Bisa Di Edit Karena status bukan pending');
            return redirect()->to('surat/keluar');
        }

        $data = [
            'id_kategori' => htmlspecialchars($this->request->getVar('id_kategori'), true),
            'nama_surat' => htmlspecialchars($this->request->getVar('nama_surat'), true),
        ];

        $data = createLog($data, 1);
        $res = $this->modelsurat->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Updated Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Updated Failed');
        }
        return redirect()->to('surat/keluar');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        if (session()->get('id_role') == 2 || session()->get('id_role') == 3) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('surat/keluar');
        }

        $result = $this->modelsurat->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('surat/keluar');
        }

        $cekUser = $this->modelsurat->where('cid', session()->get('id_user'))->where('id_surat', $id)->first();
        if (!$cekUser) {
            $this->alert->set('warning', 'Warning', 'Bukan bukan punya kamu');
            return redirect()->to('surat/keluar');
        }

        $cekStatus = $this->modelsurat->where('id_status != ', 1)->where('id_surat', $id)->first();
        if ($cekStatus) {
            $this->alert->set('warning', 'Warning', 'Gak Bisa Di Edit Karena status bukan pending');
            return redirect()->to('surat/keluar');
        }

        $res = $this->modelsurat->delete($id);
        if ($res) {
            $this->alert->set('success', 'Success', 'Delete Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Delete Failed');
        }

        return redirect()->to('surat/keluar');
    }
}
