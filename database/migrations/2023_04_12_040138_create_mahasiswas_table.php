<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    // up() adalah method yang akan dijalankan ketika migration dijalankan. Pada method ini, kita mendefinisikan bagaimana membuat tabel mahasiswas. Dalam hal ini, kita menggunakan Schema::create untuk membuat tabel dan mendefinisikan struktur kolom-kolom pada tabel dengan menggunakan instance dari class Blueprint.
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->integer('nim');
            // digunakan untuk menambahkan kolom nim dengan tipe data integer.
            $table->unique('nim');
            //  digunakan untuk menambahkan constraint unique pada kolom nim.
            $table->string('nama');
            // digunakan untuk menambahkan kolom nama dengan tipe data string.
            $table->string('jurusan');
            //$table->string('jurusan'); digunakan untuk menambahkan kolom jurusan dengan tipe data string.
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
