<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    protected Collection $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'No Order',
            'Nomor VA',
            'Qty',
            'Harga',
            'Platform',
            'Tanggal Dibuat',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->nama_barang,
            $order->no_order,
            $order->nomor_va,
            $order->qty,
            $order->harga,
            $order->platform,
            $order->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
