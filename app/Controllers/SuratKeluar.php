<?php

namespace App\Controllers;

use App\Models\KategoriSuratModel;
use App\Models\SuratHistoryModel;
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
    private $modelsurathistory;
    private $title = "Surat Keluar";
    public function __construct()
    {
        $this->modelkategorisurat = new KategoriSuratModel();
        $this->modelsurathistory = new SuratHistoryModel();
        $this->modelsurat = new SuratModel();
    }


    public function index()
    {


        if (session()->get('id_role') == 1 || session()->get('id_role') == 2 || session()->get('id_role') == 3) {
            $getAll = $this->modelsurat->select('tb_surat.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat.cid')->join('tb_user as u', 'u.id_user = tb_surat.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat.id_status')->orderBy('id_surat', 'DESC')->where('tb_surat_kategori.is_out', 1)->findAll();
        } else {
            $getAll = $this->modelsurat->select('tb_surat.*, is_out, nama_kategori, nama_status, c.username as pemohon, u.username as approve')->join('tb_user as c', 'c.id_user = tb_surat.cid')->join('tb_user as u', 'u.id_user = tb_surat.uid', 'left')->join('tb_surat_kategori', 'tb_surat_kategori.id_kategori = tb_surat.id_kategori')->join('tb_status', 'tb_status.id_status = tb_surat.id_status')->where('tb_surat.cid', session()->get('id_user'))->orderBy('id_surat', 'DESC')->where('tb_surat_kategori.is_out', 1)->findAll();
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
            'perihal' => htmlspecialchars($this->request->getVar('perihal'), true),
            'kepada' => htmlspecialchars($this->request->getVar('kepada'), true),
            'nama_surat' => '',
            'no_surat' => '',
            'file_surat' => '',
            'id_status' => 1,
        ];

        $data = createLog($data, 0);
        $res = $this->modelsurat->save($data);
        $id_surat = $this->modelsurat->select('id_surat')->orderBy('id_surat', 'DESC')->first()['id_surat'];

        $data_history = [

            'id_surat' => $id_surat,
            'id_kategori' => htmlspecialchars($this->request->getVar('id_kategori'), true),
            'perihal' => htmlspecialchars($this->request->getVar('perihal'), true),
            'kepada' => htmlspecialchars($this->request->getVar('kepada'), true),
            'nama_surat' => '',
            'no_surat' => '',
            'file_surat' => '',
            'id_status' => 1,
        ];
        $data_history = createLog($data_history, 0);
        $this->modelsurathistory->save($data_history);

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

        if (session()->get('id_role') == 4) {
            $cekUser = $this->modelsurat->where('cid', session()->get('id_user'))->where('id_surat', $id)->first();
            if (!$cekUser) {
                $this->alert->set('warning', 'Warning', 'Bukan punya kamu');
                return redirect()->to('surat/keluar');
            }
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
            'status' => $this->modelsurat->getStatus(),
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

        if (session()->get('id_role') == 4) {
            $cekUser = $this->modelsurat->where('cid', session()->get('id_user'))->where('id_surat', $id)->first();
            if (!$cekUser) {
                $this->alert->set('warning', 'Warning', 'Bukan punya kamu');
                return redirect()->to('surat/keluar');
            }
        }

        $cekStatus = $this->modelsurat->where('id_status != ', 1)->where('id_surat', $id)->first();
        if ($cekStatus) {
            $this->alert->set('warning', 'Warning', 'Gak Bisa Di Edit Karena status bukan pending');
            return redirect()->to('surat/keluar');
        }


        if ($this->request->getVar('perihal')) {
            $data = [
                'id_kategori' => htmlspecialchars($this->request->getVar('id_kategori'), true),
                'perihal' => htmlspecialchars($this->request->getVar('perihal'), true),
                'kepada' => htmlspecialchars($this->request->getVar('kepada'), true),

            ];
            $data_history = [
                'id_kategori' => htmlspecialchars($this->request->getVar('id_kategori'), true),
                'perihal' => htmlspecialchars($this->request->getVar('perihal'), true),
                'kepada' => htmlspecialchars($this->request->getVar('kepada'), true),

            ];
            $id_kategori = $data['id_kategori'];
            $id_status = $result['id_status'];
        } else {
            $dataSurat = $this->request->getFile('file_surat');
            $fileName = '';
            $data = [
                'no_surat' => htmlspecialchars($this->request->getVar('no_surat'), true),
                'nama_surat' => htmlspecialchars($this->request->getVar('nama_surat'), true),
                'id_status' => htmlspecialchars($this->request->getVar('id_status'), true),
            ];

            $data_history = [
                'no_surat' => htmlspecialchars($this->request->getVar('no_surat'), true),
                'nama_surat' => htmlspecialchars($this->request->getVar('nama_surat'), true),
                'id_status' => htmlspecialchars($this->request->getVar('id_status'), true),
            ];

            if ($dataSurat->getError() != 4) {
                $fileName = $dataSurat->getRandomName();
                $dataSurat->move('assets/upload/surat/', $fileName);
                $data['file_surat'] = $fileName;
                $data_history['file_surat'] = $fileName;
            }
            $data = createLog($data, 1);
            $id_kategori = $result['id_kategori'];
            $id_status = $data['id_status'];
        }



        $res = $this->modelsurat->update($id, $data);

        $data_history['perihal'] = $result['perihal'];
        $data_history['kepada'] = $result['kepada'];
        $data_history['id_surat'] = $id;
        $data_history['id_kategori'] = $id_kategori;
        $data_history['id_status'] = $id_status;
        $data_history['cid'] =  $result['cid'];
        $data_history['uid'] =  session()->get('id_user');

        $this->modelsurathistory->save($data_history);
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

        if (session()->get('id_role') == 4) {
            $cekUser = $this->modelsurat->where('cid', session()->get('id_user'))->where('id_surat', $id)->first();
            if (!$cekUser) {
                $this->alert->set('warning', 'Warning', 'Bukan punya kamu');
                return redirect()->to('surat/keluar');
            }
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
