<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin\ProdukModel;
use Config\Validation;

class Produk extends BaseController
{
    protected $halaman;
    protected $title;
    protected $produk;

    public function __construct()
    {
        $this->title = 'Produk';
        $this->halaman = 'produk';

        $this->produk = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'halaman' => $this->halaman,
            'main' => 'produk/index',
        ];
        return view('layout/template', $data);
    }

    public function ajaxList()
    {
        $draw       = $_REQUEST['draw'];
        $length     = $_REQUEST['length'];
        $start      = $_REQUEST['start'];
        $search     = $_REQUEST['search']["value"];

        $total  = $this->produk->ajaxGetTotal();
        $output = [
            'length'        => $length,
            'draw'          => $draw,
            'recordsTotal'  => $total,
            'recordsFiltered' => $total,
        ];

        if($search !== ''){
            $list = $this->produk->ajaxGetDataSearch($search, $length, $start);
        }else{
            $list = $this->produk->ajaxGetData($length, $start);
        }

        if($search !== ''){
            $total_search = $this->produk->ajaxGetTotalSearch($search);
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
            $status = '
            <div class="text-center">
                <a href="javascript:void(0)" data-toggle="toooltip" title="'.($temp['status'] == '0' ? 'Aktifkan' : 'Non-aktifkan').'" onclick="ajaxStatus('.$temp['id'].')"> '.formatStatus($temp['status']).'</a>
            </div>
            ';

            $gambar = '
            <div class="text-center">
                <img src="' . base_url('/uploads/img/' . $temp['gambar']).'" alt="'.$temp['gambar'].'" width="125px" height="100px">
            ';

            $row = [];
            $row[] = $no++;
            $row[] = $gambar;
            $row[] = $temp['nama_produk'];
            $row[] = $temp['harga'];
            $row[] = $temp['kategori'];
            $row[] = $temp['deskripsi'];
            $row[] = $status;
            $row[] = $aksi;

            $data[] = $row;
        }

        $output['data'] = $data;

        echo json_encode($output);
        exit();
    }
}