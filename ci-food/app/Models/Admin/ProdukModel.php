<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $userTimestamps = true;
    protected $allowedFields = [
        'nama_produk',
        'harga',
        'deskripsi',
        'gambar',
        'kategori',
        'status'
    ];

    public function getRulesValidation($method)
    {
        if($method == 'update'){
            $imgRules =  'max_size[gambar,1024]|is_image[gambar]|ext_in[gambar,jpg,png,jpg,jpeg]';
        }else{
            $imgRules =  'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|ext_in[gambar,jpg,png,jpg,jpeg]';

        }
    
        $rulesValidation = [
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi !',
                ]
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi !',
                ]
            ],
            
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi !',
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi !',
                ]
            ],
            'gambar' => [
                'label' => 'Gambar',
                'rules' =>$imgRules,
                'errors' => [
                    'uploades' => '{field} harus dipilih !',
                    'max_size' => '{field} melebihi ukuran yang ditentukan (max 1MB)',
                    'is_image' => 'format {field} tidak sesuai',
                    'ext_in' => 'format {field} tidak sesuai',
                    ]
            ],
        ];

        return $rulesValidation;
    } 

    public function ajaxGetData($length, $start)
    {
       $result = $this->orderBy('id', 'desc')
       ->findAll($start, $length);

         return $result;
    }

    public function ajaxGetDataSearch($search, $length, $start)
    {
        $result = $this->like('nama_produk', $search)
        ->orLike('harga', $search)
        ->orLike('deskripsi', $search)
        ->orLike('kategori', $search)
        ->orderBy('id', 'desc')
        ->findAll($start, $length);

        return $result;
    }

    public function ajaxGetTotal()
    {
        $result = $this->countAll();

        if(isset($result)){
            return $result;
        }

        return 0;
    }

    public function ajaxGetTotalSearch($search)
    {
        $result = $this->like('nama_produk', $search)
        ->orLike('harga', $search)
        ->orLike('deskripsi', $search)
        ->orLike('kategori', $search)
        ->countAllResult();

       return $result;
    }
}