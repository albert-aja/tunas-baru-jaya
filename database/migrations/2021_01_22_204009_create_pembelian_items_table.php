<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_item', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pembelian');
            $table->uuid('produk');
            $table->double('kuantitas');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_item');
    }
}
