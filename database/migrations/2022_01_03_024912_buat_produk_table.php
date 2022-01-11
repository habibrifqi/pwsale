<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuatProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('produk', function (Blueprint $table) {
            //
            $table->id('id_produk');
            $table->foreignId('id_kategori')->references('id_kategori')->on('kategori')->onUpdate('restrict')->onDelete('restrict');
            $table->integer('nama_produk')->unique();
            $table->string('merk')->nullable();
            $table->integer('harga_beli');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('harga_jual');
            $table->integer('stock');
            $table->timestamps(); 
            
            //  $table->foreign('id_kategori')
            // ->references('id_kategori')
            // ->on('kategori')
            // ->onUpdate('restrict')
            // ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('produk');
    }
}
