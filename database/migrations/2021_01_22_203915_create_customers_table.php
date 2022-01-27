<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('hp')->nullable();
            $table->string('tlp')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('customer');
    }
}
