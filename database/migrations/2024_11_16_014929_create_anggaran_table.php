<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranTable extends Migration
{
    public function up()
    {
        Schema::create('anggaran', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_anggaran');
            $table->text('keterangan_anggaran');
            $table->decimal('jumlah_anggaran', 15, 2);
            $table->text('rencana_anggaran');
            $table->timestamps();
        
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggaran');
    }
}

?>