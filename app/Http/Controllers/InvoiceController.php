<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(10);
        return view('invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.show', compact('invoice'));
    }

    public function download($id)
    {
        $invoice = Invoice::findOrFail($id);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('invoice.invoice_pdf', compact('invoice'));
        return $pdf->download('Invoice-'.$invoice->invoice_number.'.pdf');
    }

        public function destroy($id)
        {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
            return redirect()->route('invoice.index')->with('success', 'Invoice berhasil dihapus.');
        }
}
