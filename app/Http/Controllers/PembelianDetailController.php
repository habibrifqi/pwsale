<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;

class PembelianDetailController extends Controller
{
    //
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::orderBy('nama_produk')->get();
        $supplier = Supplier::find(session('id_supplier'));
        $diskon = Pembelian::find($id_pembelian)->diskon ?? 0;

        // return $diskon;

        // return $produk;
        if(!$supplier){
            abort(404);
        }

        return view('pembelian_detail.index', compact('id_pembelian','produk','supplier','diskon'));
    }

    public function data($id)
    {
        $detail = PembelianDetail::with('produk')
        ->where('id_pembelian', $id)->get();
        
        $data = array();
        $total = 0;
        $total_item = 0;
       
        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk']     = '<span class="badge bg-success center">'.$item->produk['kode_produk'].'</span>';
            $row['nama_produk']     = $item->produk['nama_produk'];
            $row['harga_beli']      = 'Rp. '. $item->harga_beli;
            $row['jumlah']          ='<input type="number" class="form-control input-sm quantity"data-id="'.$item->id_pembelian_detail.'" name="jumlah_ '.$item->id_pembelian_detail .'"value="'.$item->jumlah.'">';
            $row['subtotal']        ='Rp. '. $item->subtotal;
            $row['aksi']            = '
            <div class="btn-group">
            <button onclick=deleteData(`'.route('pembelian_detail.destroy', $item->id_pembelian_detail).'`) class="btn btn-xs btn-info btb-flat"><i class="fa fa-trash"></i></button>
            <div>
        ';

            $data[] = $row;

            $total += $item->harga_beli * $item->jumlah;
            $total_item += $item->jumlah;
        }
        $data[] =[ 
            'kode_produk'=> '<div class="total hide">'. $total.'</div> <div class="total_item hide">'.$total_item.'</div>',
            'nama_produk'=> '',
            'harga_beli'=> '',
            'jumlah'=> '',
            'subtotal'=> '',
            'aksi'=> '',
        ];

        // return $data;
        // return $data;
        return datatables()
        ->of($data)
        ->addIndexColumn()
        // ->addcolumn('nama_produk', function($detail){
        //     return $detail->produk['nama_produk'];
        // })
        // ->addcolumn('kode_produk', function($detail){
        //     return '<span class="badge bg-success center">'.$detail->produk['kode_produk'].'</span>';
        // })
        // ->addcolumn('harga_beli', function($detail){
        //     return  'Rp. '. $detail->harga_beli;
        // })
        // ->addcolumn('jumlah', function($detail){
        //     return '<input type="number" class="form-control input-sm quantity"data-id="'.$detail->id_pembelian_detail.'" name="jumlah_ '.$detail->id_pembelian_detail .'"value="'.$detail->jumlah.'">';
        // })
        // ->addcolumn('subtotal', function($detail){
        //     return  'Rp. '. $detail->subtotal;
        // })
        // ->addColumn('aksi', function($item){
        //     return '
        //     <div class="btn-group">
        //     <button onclick=deleteData(`'.route('pembelian_detail.destroy', $detail->id_pembelian_detail).'`) class="btn btn-xs btn-info btb-flat"><i class="fa fa-trash"></i></button>
        //     <div>
        // ';
        // })
        ->rawColumns(['aksi','kode_produk','jumlah'])
        ->make(true);
    }
    

    public function store(Request $request)
    {
        // return $request;
        //  return dump($request);
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        // $produk = Produk::find(44);
        // return $request;
        if(! $produk){
            return response()->json('data gagal di simpan',400);
        }
        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('data tersimpan',200);
    }

    public function update(Request $request, $id)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }

    public function destroy($id){
        $detail = PembelianDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

     public function loadForm($diskon, $total )
    {
        // dd($diskon,$total);
        $bayar = $total - ($diskon / 100 * $total);
        $data = [
            'totalrp' => format_uang($total),
            'bayar' =>$bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar).' Rupiah')
        ];

        return response()->json($data);
    }
    


}
