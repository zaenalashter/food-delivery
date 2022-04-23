<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriModel;
use Config\Validation;

class Kategori extends BaseController
{
    protected $halaman;
    protected $title;
    protected $kategori;

    public function __construct()
    {
        $this->title = 'Kategori';
        $this->halaman = 'kategori';

        $this->kategori = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'halaman' => $this->halaman,
            'main' => 'kategori/index',
        ];
        return view('layout/template', $data);
    }

    public function ajaxList()
    {
        $draw       = $_REQUEST['draw'];
        $length     = $_REQUEST['length'];
        $start      = $_REQUEST['start'];
        $search     = $_REQUEST['search']["value"];

        $total  = $this->kategori->ajaxGetTotal();
        $output = [
            'length'        => $length,
            'draw'          => $draw,
            'recordsTotal'  => $total,
            'recordsFiltered' => $total,
        ];

        if($search !== ''){
            $list = $this->kategori->ajaxGetDataSearch($search, $length, $start);
        }else{
            $list = $this->kategori->ajaxGetData($length, $start);
        }

        if($search !== ''){
            $total_search = $this->kategori->ajaxGetTotalSearch($search);
            $output = [
                'recordsTotal'  => $total_search,
                'recordsFiltered' => $total_search,
            ];
        }

        $data = [];
        $no = $start + 1;
        foreach ($list as $temp){
            $aksi = '
            <div class="text-center">
            <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="toooltip" title="Edit Data" onclick="ajaxEdit('.$temp['id'].')">
                <i class="fa fa-pencil"></i>
            </a>
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-toggle="toooltip" title="Edit Data" onclick="ajaxDelete('.$temp['id'].')">
                <i class="fa fa-trash"></i>
            </a>
            </div>
            ';

            $row = [];
            $row[] = $no++;
            $row[] = $temp['nama_kategori'];
            $row[] = formatStatus($temp['status']);
            $row[] = $aksi;

            $data[] = $row;
        }

        $output['data'] = $data;

        echo json_encode($output);
        exit();
    }

    public function ajaxSave()
    {
        $this->_validate('save');

        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'status' => '1',
        ];

        if($this->kategori->save($data)){
            echo json_encode(['status' => true]);
        }else{
            echo json_encode(['status' => false]);
        }
    }

    public function ajaxEdit($id)
    {
        $kategori = $this->kategori->find($id);
        echo json_encode($kategori);
    }

    public function ajaxUpdate()
    {
        $this->_validate('update');

        $id = $this->request->getVar('id');
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'status' => '1',
        ];

        if($this->kategori->update($id, $data)){
            echo json_encode(['status' => true]);
        }else{
            echo json_encode(['status' => false]);
        }
    }

    public function ajaxDelete($id)
    {
        if($this->kategori->delete($id)){
            echo json_encode(['status' => true]);
        }else{
            echo json_encode(['status' => false]);
        }
    }

    public function _validate($method)
    {
        if(!$this->validate($this->kategori->getRulesValidation($method)))
        {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = true;

            if($validation->hasError('nama_kategori'))
            {
                $data['inputerror'][] = 'nama_kategori';
                $data['error_string'][] = $validation->getError('nama_kategori');
                $data['status'] = false;
            }

            if($data['status'] == false)
            {
                echo json_encode($data);
                exit();
            }
        }
    }
}