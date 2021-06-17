<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public $view = 'admin.sales.';

    public function index()
    {
        $sales = Sale::where('status', 'approved')->orderBy('created_at', 'desc')->get();

        return view($this->view . 'index', compact('sales'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $sale = Sale::where('id', $id)->where('status', 'approved')->first();

        if (!$sale) {
            return redirect()->back();
        }

        return view($this->view . 'show', compact('sale'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->back()->with('success', 'Sale successfully deleted');
    }

    public function approve($id) {
        $sale = Sale::find($id);
        $sale->status = 'approved';
        $sale->update();

        return redirect()->back()->with('success', 'Status successfull updated');
    }
}
