<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->bigIncrements('support_id');
            $table->unsignedBigInteger('lapor_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign("lapor_id")->references("lapor_id")->on("lapors")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
