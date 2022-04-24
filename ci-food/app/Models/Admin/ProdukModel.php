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