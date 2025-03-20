<?php

namespace App\Imports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenjualanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Penjualan([
            'produk_id'      => $row['produk_id'], 
            'jumlah'         => $row['jumlah'], 
            'harga'          => $row['harga'], 
            'total_harga'    => $row['jumlah'] * $row['harga'], 
           
            'tanggal'        => $row['tanggal'], 
        ]);
    }
}
