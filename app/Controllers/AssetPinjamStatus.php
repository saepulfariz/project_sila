<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AssetPinjamStatus extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    private $model;
    private $link = 'asset/pinjam/status';
    private $view = 'asset/pinjam/status';
    private $title = 'Asset Pinjam Status';
    public function __construct()
    {
        $this->model = new \App\Models\AssetPinjamStatusModel();
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
