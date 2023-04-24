<?php

namespace App\Controllers;

use App\Models\HelpdeskModel;
use App\Models\KategoriHelpdeskModel;
use CodeIgniter\RESTful\ResourceController;

class KategoriHelpdesk extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    private $modelkategorihelpdesk;
    private $modelhelpdesk;
    private $title = 'Kategori Helpdesk';
    public function __construct()
    {
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelkategorihelpdesk = new KategoriHelpdeskModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'kategori' => $this->modelkategorihelpdesk->findAll()
        ];

        return view('helpdesk/kategori/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return redirect()->to('helpdesk/kategori');
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
        ];

        return view('helpdesk/kategori/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];

        $res = $this->modelkategorihelpdesk->save($data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to('helpdesk/kategori');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $result = $this->modelkategorihelpdesk->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('helpdesk/kategori');
        }

        $data = [
            'title' => $this->title,
            'kategori' => $result
        ];

        return view('helpdesk/kategori/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];

        $res = $this->modelkategorihelpdesk->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Update Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Update Failed');
        }
        return redirect()->to('helpdesk/kategori');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $result = $this->modelkategorihelpdesk->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('helpdesk/kategori');
        }

        $cekUsing = $this->modelhelpdesk->where('id_kategori', $id)->first();
        if ($cekUsing) {
            $this->alert->set('warning', 'Warning', 'Permission Denied');
            return redirect()->to('helpdesk/kategori');
        }

        $res = $this->modelkategorihelpdesk->delete($id);
        if ($res) {
            $this->alert->set('success', 'Success', 'Delete Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Delete Failed');
        }
        return redirect()->to('helpdesk/kategori');
    }
}
