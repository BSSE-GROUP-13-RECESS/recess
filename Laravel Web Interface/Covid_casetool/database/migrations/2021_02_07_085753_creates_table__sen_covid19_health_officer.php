<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesTableSenCovid19HealthOfficer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('SenCovid19HealthOfficer', function (Blueprint $table) {
            $table->string('username')->nullable(false)->unique();
            $table->bigInteger('hospitalId')->nullable(false);
            $table->enum('present',['Yes','No, was promoted','No'])->nullable(false)->default('Yes');
            $table->primary(['username','hospitalId']);
        });
        Schema::table('SenCovid19HealthOfficer',function (Blueprint $table){
            $table->foreign('username')->references('username')->on('HealthWorkers')->cascadeOnUpdate();
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
        Schema::dropIfExists('SenCovid19HealthOfficer');
    }
}
