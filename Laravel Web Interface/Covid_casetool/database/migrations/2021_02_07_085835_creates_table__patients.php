<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesTablePatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patients', function (Blueprint $table) {
            $table->bigInteger('patientId')->unsigned()->autoIncrement();
            $table->string('patientName')->nullable(false);
            $table->date('dateOfId')->nullable(false);//as yyyy-mm-dd
            $table->enum('gender',['M','F'])->nullable(false);
            $table->enum('category',['symptomatic','asymptomatic'])->nullable(false);
            $table->string('CHOUsername')->nullable(true);
            $table->string('CCUsername')->nullable(true);
            $table->string('SCHOUsername')->nullable(true);
            $table->foreign('CHOUsername')->references('username')->on('Covid19HealthOfficer')->cascadeOnUpdate();
            $table->foreign('CCUsername')->references('username')->on('Covid19Consultant')->cascadeOnUpdate();
            $table->foreign('SCHOUsername')->references('username')->on('SenCovid19HealthOfficer')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Patients');
    }
}
