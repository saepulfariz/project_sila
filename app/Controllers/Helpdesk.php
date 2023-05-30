<?php

namespace App\Controllers;

use App\Models\HelpdeskModel;
use App\Models\KategoriHelpdeskModel;
use CodeIgniter\RESTful\ResourceController;

class Helpdesk extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    private $modelhelpdesk;
    private $modelkategorihelpdesk;
    private $title = 'Helpdesk';
    public function __construct()
    {
        $this->modelhelpdesk = new HelpdeskModel();
        $this->modelkategorihelpdesk = new KategoriHelpdeskModel();
    }

    public function index()
    {
        if (session()->get('id_role') == 4) {
            $helpdesk = $this->modelhelpdesk->select('tb_helpdesk.*')->select('nama_lengkap')->select('nama_kategori')->select('nama_status')->join('tb_helpdesk_kategori', 'tb_helpdesk.id_kategori = tb_helpdesk_kategori.id_kategori')->join('tb_status', 'tb_status.id_status = tb_helpdesk.id_status')->join('tb_user', 'tb_user.id_user = tb_helpdesk.cid')->where('tb_helpdesk.cid', session()->get('id_user'))->findAll();
        } else {
            $helpdesk = $this->modelhelpdesk->select('tb_helpdesk.*')->select('nama_lengkap')->select('nama_kategori')->select('nama_status')->join('tb_helpdesk_kategori', 'tb_helpdesk.id_kategori = tb_helpdesk_kategori.id_kategori')->join('tb_status', 'tb_status.id_status = tb_helpdesk.id_status')->join('tb_user', 'tb_user.id_user = tb_helpdesk.cid')->findAll();
        }

        $data = [
            'title' => $this->title,
            'helpdesk' => $helpdesk
        ];

        return view('helpdesk/list/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return redirect()->to('helpdesk/list');
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
            'kategori' => $this->modelkategorihelpdesk->findAll()
        ];

        return view('helpdesk/list/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {



        if (!$this->validate([
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'gambar' => [
                'rules' => 'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,2048]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran File Maksimal 2 MB'
                ]

            ]
        ])) {
            $this->alert->set('warning', 'Warning', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataGambar = $this->request->getFile('gambar');
        $fileName = '';
        if ($dataGambar->getError() != 4) {
            $fileName = $dataGambar->getRandomName();
            $dataGambar->move('assets/upload/helpdesk/', $fileName);
        }

        $data = [
            'deskripsi' => $this->request->getVar('deskripsi'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_dosen' => $this->request->getVar('nama_dosen'),
            'gambar' => $fileName,
            'id_status' => 1,
            'id_user' => session()->get('id_user'),
        ];

        $data = createLog($data, 0);
        $res = $this->modelhelpdesk->save($data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to('helpdesk/list');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        // return redirect()->to('helpdesk/list');
        $result = $this->modelhelpdesk->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('helpdesk/list');
        }

        if (session()->get('id_role') == 4) {
            $cekData = $this->modelhelpdesk->where('cid', session()->get('id_user'))->find($id);
            if (!$cekData) {
                $this->alert->set('warning', 'Warning', 'Bukan Punya Mu');
                return redirect()->to('helpdesk/list');
            }
        }

        $data = [
            'title' => $this->title,
            'kategori' => $this->modelkategorihelpdesk->findAll(),
            'helpdesk' => $result
        ];

        return view('helpdesk/list/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $result = $this->modelhelpdesk->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('helpdesk/list');
        }

        if (session()->get('id_role') == 4) {
            $cekData = $this->modelhelpdesk->where('cid', session()->get('id_user'))->find($id);
            if (!$cekData) {
                $this->alert->set('warning', 'Warning', 'Bukan Punya Mu');
                return redirect()->to('helpdesk/list');
            }
        }


        $dataGambar = $this->request->getFile('gambar');
        $fileName = '';


        $data = [
            'deskripsi' => $this->request->getVar('deskripsi'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_dosen' => $this->request->getVar('nama_dosen'),
        ];

        if ($dataGambar->getError() != 4) {
            $fileName = $dataGambar->getRandomName();
            $dataGambar->move('assets/upload/helpdesk/', $fileName);
            $data['gambar'] = $fileName;
        }

        if (session()->get('id_role') != 4) {
            $data['catatan'] = htmlspecialchars($this->request->getVar('catatan'));
            $data['id_status'] = htmlspecialchars($this->request->getVar('id_status'));
        }

        $data = createLog($data, 1);
        $res = $this->modelhelpdesk->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Updated Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Updated Failed');
        }
        return redirect()->to('helpdesk/list');
    }


    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $result = $this->modelhelpdesk->find($id);
        if (!$result) {
            $this->alert->set('warning', 'Warning', 'NOT VALID');
            return redirect()->to('helpdesk/list');
        }

        if (session()->get('id_role') == 4) {
            $cekData = $this->modelhelpdesk->where('cid', session()->get('id_user'))->find($id);
            if (!$cekData) {
                $this->alert->set('warning', 'Warning', 'Bukan Punya Mu');
                return redirect()->to('helpdesk/list');
            }
        }

        $res = $this->modelhelpdesk->delete($id);
        if ($res) {
            $this->alert->set('success', 'Success', 'Delete Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Delete Failed');
        }
        return redirect()->to('helpdesk/list');
    }
}
