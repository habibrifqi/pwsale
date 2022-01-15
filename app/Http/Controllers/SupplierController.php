<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //
    public function index(){
        return view('supplier.index');
    }

    public function data()
    {
        $supplier = Supplier::orderBy('id_supplier','desc')->get();
        
        return datatables()
        ->of($supplier)
        ->addIndexColumn()
        ->addColumn('aksi', function($supplier){
            return '
            <div class="btn-group">
            <button onclick=editForm(`'.route('supplier.update', $supplier->id_supplier).'`) class="btn btn-xs btn-info btb-flat"><i class="fa fa-edit"></i></button>
            <button onclick=deleteData(`'.route('supplier.destroy', $supplier->id_supplier).'`) class="btn btn-xs btn-info btb-flat"><i class="fa fa-trash"></i></button>
            <div>
        ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function store(Request $request)
    {
        
        $supplier = Supplier::create($request->all());


        return response()->json('data berhasil di simpan', 200);
        // return $vals;
    }

    public function show($id)
    {
        //
        $supplier = Supplier::find($id);

        return response()->json($supplier);
    }

    public function update(Request $request, $id)
    {
        //
        $supplier = Supplier::find($id);

        $supplier->update($request->all());

        return response()->json('data berhasil di simpan', 200);
    }

    public function destroy($id)
    {
        //
        $produk = Supplier::find($id);
        $produk->delete();

        return response(null, 204);
    }
}
