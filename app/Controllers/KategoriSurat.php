<?php

namespace App\Controllers;

use App\Models\KategoriSuratModel;
use App\Models\SuratModel;
use CodeIgniter\RESTful\ResourceController;

class KategoriSurat extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    private $modelkategorisurat;
    private $modelsurat;
    private $title = 'Kategori Surat';
    public function __construct()
    {
        $this->modelkategorisurat = new KategoriSuratModel();
        $this->modelsurat = new SuratModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'kategori' => $this->modelkategorisurat->findAll()
        ];

        return view('surat/kategori/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return redirect()->to('surat/kategori');
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'title' => $this->title
        ];

        return view('surat/kategori/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'is_out' => $this->request->getVar('is_out'),
        ];

        $res = $this->modelkategorisurat->save($data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to('surat/kategori');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $res = $this->modelkategorisurat->find($id);
        if (!$res) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('surat/kategori');
        }

        $data = [
            'title' => $this->title,
            'kategori' => $res
        ];

        return view('surat/kategori/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'is_out' => $this->request->getVar('is_out'),
        ];

        $res = $this->modelkategorisurat->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Update Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Update Failed');
        }
        return redirect()->to('surat/kategori');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $result = $this->modelkategorisurat->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('surat/kategori');
        }

        $cekUsing = $this->modelsurat->where('id_kategori', $id)->findAll();
        if ($cekUsing) {
            $this->alert->set('warning', 'Warning', 'Permission Denied');
            return redirect()->to('surat/kategori');
        }

        $res = $this->modelkategorisurat->delete($id);
        if ($res) {
            $this->alert->set('success', 'Success', 'Delete Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Delete Failed');
        }

        return redirect()->to('surat/kategori');
    }
}
