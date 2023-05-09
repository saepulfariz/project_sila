<?php

namespace App\Controllers;

use App\Models\KategoriSuratModel;
use App\Models\SuratModel;
use CodeIgniter\RESTful\ResourceController;

class SuratMasuk extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */


    private $modelsurat;
    private $modelsuratkategori;
    private $title = "Surat Masuk";
    public function __construct()
    {
        $this->modelsurat = new SuratModel();
        $this->modelsuratkategori = new KategoriSuratModel();
    }


    public function index()
    {
        $data = [
            'title' => $this->title,
            'surat' => $this->modelsurat->select('tb_surat.*, nama_kategori, is_out')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->where('is_out', 0)->findAll()
        ];

        return view('surat/masuk/index', $data);
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
            'kategori' => $this->modelsuratkategori->where('is_out', 0)->findAll()
        ];

        return view('surat/masuk/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $dataSurat = $this->request->getFile('file_surat');
        $fileName = '';
        $data = [
            'no_surat' => htmlspecialchars($this->request->getVar('no_surat'), true),
            'nama_surat' => htmlspecialchars($this->request->getVar('nama_surat'), true),
            'id_kategori' => htmlspecialchars($this->request->getVar('id_kategori'), true),
            'id_status' => 2
        ];

        if ($dataSurat->getError() != 4) {
            $fileName = $dataSurat->getRandomName();
            $dataSurat->move('assets/upload/surat/', $fileName);
            $data['file_surat'] = $fileName;
        }

        $data = createLog($data, 0);
        $res = $this->modelsurat->save($data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to('surat/masuk');
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
            return redirect()->to('surat/masuk');
        }

        $data = [
            'title' => $this->title,
            'surat' => $result,
            'kategori' => $this->modelsuratkategori->where('is_out', 0)->findAll()
        ];

        return view('surat/masuk/edit', $data);
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
            return redirect()->to('surat/masuk');
        }

        $dataSurat = $this->request->getFile('file_surat');
        $fileName = '';
        $data = [
            'no_surat' => htmlspecialchars($this->request->getVar('no_surat'), true),
            'nama_surat' => htmlspecialchars($this->request->getVar('nama_surat'), true),
            'id_kategori' => htmlspecialchars($this->request->getVar('id_kategori'), true),
        ];

        if ($dataSurat->getError() != 4) {
            $fileName = $dataSurat->getRandomName();
            $dataSurat->move('assets/upload/surat/', $fileName);
            $data['file_surat'] = $fileName;
        }

        $data = createLog($data, 1);
        $res = $this->modelsurat->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Update Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Update Failed');
        }
        return redirect()->to('surat/masuk');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $result = $this->modelsurat->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('surat/masuk');
        }


        $res = $this->modelsurat->delete($id);
        if ($res) {
            $this->alert->set('success', 'Success', 'Delete Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Delete Failed');
        }

        return redirect()->to('surat/masuk');
    }
}
