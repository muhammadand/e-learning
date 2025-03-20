<?php
namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromCollection, WithHeadings
{
    protected $tahun, $bulan;

    public function __construct($tahun, $bulan)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Penjualan::whereYear('tanggal', $this->tahun)
                        ->whereMonth('tanggal', $this->bulan)
                        ->get(['produk_id', 'jumlah', 'tanggal', 'keterangan']);
    }

    public function headings(): array
    {
        return ["Produk ID", "Jumlah Terjual", "Tanggal", "Keterangan"];
    }
}
