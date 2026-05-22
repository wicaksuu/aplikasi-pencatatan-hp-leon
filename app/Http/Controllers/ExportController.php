<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    private function buildOrderQuery(Request $request)
    {
        $query = Order::query();

        if ($request->filled('archive_id')) {
            $query->where('archive_id', $request->input('archive_id'));
        } else {
            $query->whereNull('archive_id');
        }

        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', $request->input('date_start'));
        }

        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', $request->input('date_end'));
        }

        if ($request->filled('platform')) {
            $query->where('platform', $request->input('platform'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%'.$search.'%')
                    ->orWhere('no_order', 'like', '%'.$search.'%')
                    ->orWhere('nomor_va', 'like', '%'.$search.'%');
            });
        }

        return $query->latest()->get();
    }

    public function excel(Request $request)
    {
        $orders = $this->buildOrderQuery($request);
        $fileName = 'orders_'.date('YmdHis').'.xlsx';

        return Excel::download(new OrderExport($orders), $fileName);
    }

    public function pdf(Request $request)
    {
        $orders = $this->buildOrderQuery($request);
        $fileName = 'orders_'.date('YmdHis').'.pdf';

        $pdf = Pdf::loadView('pdf.orders', compact('orders'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream($fileName);
    }
}
