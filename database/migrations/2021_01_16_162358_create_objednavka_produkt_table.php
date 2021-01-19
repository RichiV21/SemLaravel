<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjednavkaProduktTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objednavka_produkt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("objednavka_id");
            $table->unsignedBigInteger("produkt_id");
            $table->unsignedInteger("cena")->default(0);
            $table->unsignedInteger("mnozstvo")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objednavka_produkt');
    }
}
