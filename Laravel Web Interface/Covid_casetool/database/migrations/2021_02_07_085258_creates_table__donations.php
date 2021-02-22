<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatesTableDonations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('Donations', function (Blueprint $table) {
            $table->id();
            $table->string('wellwisherName')->nullable(false);
            $table->bigInteger('amount')->unsigned()->nullable(false);
            $table->bigInteger('balance')->unsigned()->nullable(false);
            $table->string('adminEmail')->nullable(false);
            $table->timestamps();
            $table->foreign('adminEmail')->references('email')->on('users')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Donations');
    }
}
