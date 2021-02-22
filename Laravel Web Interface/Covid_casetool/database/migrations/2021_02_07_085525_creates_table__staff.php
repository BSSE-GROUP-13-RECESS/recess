<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesTableStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Staff', function (Blueprint $table) {
            $table->string('staffUsername')->primary();
            $table->string('staffFullName')->nullable(false);
            $table->bigInteger('hospitalId')->nullable(false);
        });
        Schema::table('Staff',function ($table){
            $table->foreign('hospitalId')->references('hospitalId')->on('Hospitals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Staff');
    }
}
