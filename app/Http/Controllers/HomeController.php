<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;

class HomeController extends Controller
{    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['jwt.verify']);
    }

    public function get_invoices(Request $request)
    {
        $invoice = InvoiceModel::all();
        return response()->json($invoice, 200);
    }

    public function get_invoice(Request $request, $numero_factura)
    {
        $invoice = InvoiceModel::where('numero_factura', "=", $numero_factura)
            ->get();
        return response()->json($invoice, 200);
    }

    public function set_invoice(Request $request)
    {
        $data = request()->all();
        $invoice = new InvoiceModel();
        $invoice->numero_factura = $data['numero_factura'];
        $invoice->fecha_generacion = $data['fecha_generacion'];
        $invoice->emisor = $data['emisor'];
        $invoice->receptor = $data['receptor'];
        $invoice->subtotal = intval($data['subtotal']);
        $invoice->IVA = intval($data['iva']);
        $iva = $invoice->IVA * $invoice->subtotal / 100;
        $invoice->total = $invoice->subtotal + $iva;
        $invoice->items_facturados = $data['items_facturados'];
        $invoice->save();
        return response()->json([
            'Message' => 'Registro guardado con exito'
        ], 200);
    }

    public function update_invoice(Request $request)
    {
        $data = request()->all();

        $invoiceConsult = InvoiceModel::where(
            "numero_factura",
            "=", 
            $data['numero_factura']
        )->get();
        $id = $invoiceConsult[0]['id'];
        $invoice = InvoiceModel::find($id);
        $invoice->fecha_generacion = $data['fecha_generacion'];
        $invoice->emisor = $data['emisor'];
        $invoice->receptor = $data['receptor'];
        $invoice->subtotal = intval($data['subtotal']);
        $invoice->IVA = intval($data['iva']);
        $invoice->total = intval($data['total']);
        $invoice->items_facturados = $data['items_facturados'];
        $invoice->save();

        return response()->json(
            ['Message' => 'Datos actualizados con exito'
        ], 200);
    }

    public function order_invoices(Request $request, $order)
    {
        $invoice = InvoiceModel::orderBy('numero_factura', $order)
            ->get();
        return response()->json([
            'Message' => $invoice]
        );
    }
}
