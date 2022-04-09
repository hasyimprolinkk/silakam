<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->enum('jk', ['L', 'P']);
            $table->unsignedBigInteger('alamat_id');
            $table->string('no_hp');
            $table->string('jabatan')->nullable();
            $table->string('avatar')->default('avatars/default.jpg');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('roles', ['user','admin','petugas'])->default('user');
            $table->enum('is_active',[0,1])->default(1);
            $table->string('chat_id_bot')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign("alamat_id")->references("alamat_id")->on("alamats");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
