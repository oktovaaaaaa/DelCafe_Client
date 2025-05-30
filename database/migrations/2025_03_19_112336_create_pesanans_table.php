<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('daftar_menu');
            $table->integer('total_harga');
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
?>
