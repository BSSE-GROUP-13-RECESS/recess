<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesTableHospitalHeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HospitalHeads', function (Blueprint $table) {
            $table->bigInteger('hospitalId')->nullable(false)->unique();
            $table->string('head')->nullable(false)->unique();
            $table->primary(['hospitalId','head']);
            $table->foreign('hospitalId')->references('hospitalId')->on('Hospitals');
            $table->foreign('head')->references('username')->on('HealthWorkers')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HospitalHeads');
    }
}
