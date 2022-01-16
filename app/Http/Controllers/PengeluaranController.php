<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pengeluaran.index');
    }

    public function data()
    {
        $pengeluaran = Pengeluaran::orderBy('id_pengeluaran','desc')->get();
        
        return datatables()
        ->of($pengeluaran)
        ->addIndexColumn()
        ->addColumn('nominal',function($pengeluaran){
            return "Rp. ".format_uang($pengeluaran->nominal);
        })
        ->addColumn('created_at',function($pengeluaran){
            return tanggal_indonesia($pengeluaran->created_at);
        })
        ->addColumn('aksi', function($pengeluaran){
            return '
            <div class="btn-group">
            <button onclick=editForm(`'.route('pengeluaran.update', $pengeluaran->id_pengeluaran).'`) class="btn btn-xs btn-info btb-flat"><i class="fa fa-edit"></i></button>
            <button onclick=deleteData(`'.route('pengeluaran.destroy', $pengeluaran->id_pengeluaran).'`) class="btn btn-xs btn-info btb-flat"><i class="fa fa-trash"></i></button>
            <div>
        ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $pengeluaran = Pengeluaran::create($request->all());

        return response()->json('data berhasil di simpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $pengeluaran = Pengeluaran::find($id);

        return response()->json($pengeluaran);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , $id)
    {
        //
         //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pengeluaran = Pengeluaran::find($id);

        $pengeluaran->update($request->all());

        return response()->json('data berhasil di simpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();

        return response(null, 204);
    }
}
