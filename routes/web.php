<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\SupplierController;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\PenjualanDetail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn()
    => Redirect()->route('login')
);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('home');
})->name('dashboard');

Route::group(['middleware' =>'auth'], function (){
    Route::get('/kategori/data' , [KategoriController::class, 'data'])->name('kategori.data');
    Route::resource('/kategori' , KategoriController::class);

    Route::get('/produk/data' , [ProdukController::class, 'data'])->name('produk.data');
    Route::post('/produk/delete-selected' , [ProdukController::class, 'deleteSelected'])->name('produk.delete_selected');
    Route::post('/produk/cetak_barcode' , [ProdukController::class, 'cetakBarcode'])->name('produk.cetak_barcode');
    Route::resource('/produk' , ProdukController::class);

    Route::get('/member/data' , [MemberController::class, 'data'])->name('member.data');
    Route::resource('/member' , MemberController::class);
    Route::post('/member/cetak_member' , [MemberController::class, 'cetakMember'])->name('member.cetak_member');

    Route::get('/supplier/data' , [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('/supplier' , SupplierController::class);

    Route::get('/pengeluaran/data' , [PengeluaranController::class, 'data'])->name('pengeluaran.data');
    Route::resource('/pengeluaran' , PengeluaranController::class);

    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::resource('/pembelian' , PembelianController::class)
    ->except('create');

    Route::resource('/pembelian_detail' , PembelianDetailController::class)
    ->except('create','show','edit');
    Route::get('/pembelian_detail/{id}/data' , [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}' , [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.loadform');

    Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('/penjualan' ,[PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/{id}' ,[PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}' ,[PenjualanController::class, 'destroy'])->name('penjualan.destroy');

    route::get('transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    route::post('transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
    route::get('transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
    route::get('transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
    route::get('transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');

    route::get('transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    route::get('transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadform'])->name('transaksi.loadform');
    Route::resource('/transaksi' , PenjualanDetailController::class)
        ->except('show');
});