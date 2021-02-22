<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesTableCovid19Consultant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Covid19Consultant', function (Blueprint $table) {
            $table->string('username')->nullable(false)->unique();
            $table->bigInteger('hospitalId')->nullable(false);
            $table->string('position')->nullable();
            $table->enum('present',['Yes','No, was promoted','No'])->nullable(false)->default('Yes');
            $table->primary(['username','hospitalId']);
        });
        Schema::table('Covid19Consultant',function (Blueprint $table){
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
        Schema::dropIfExists('Covid19Consultant');
    }
}
