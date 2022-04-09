<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapors', function (Blueprint $table) {
            $table->bigIncrements('lapor_id');
            $table->unsignedBigInteger('user_id');
            $table->text('keterangan');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('kategori_id');
            $table->enum('is_public',[0,1]);
            $table->enum('status',['Belum Diproses','Sedang Diproses','Selesai'])->default('Belum Diproses');
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->timestamps();

            $table->foreign("user_id")->references("user_id")->on("users")->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("petugas_id")->references("user_id")->on("users")->onDelete('set null')->onUpdate('cascade');
            $table->foreign("kategori_id")->references("kategori_id")->on("kategoris");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lapors');
    }
}
