<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesTableSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Salary', function (Blueprint $table) {
            $table->id('salaryId');
            $table->date('date')->nullable(false);
            $table->bigInteger('amount')->nullable(false);
            $table->string('adminEmail')->nullable(true);
            $table->string('staffUsername')->nullable(true);
            $table->string('CHOUsername')->nullable(true);
            $table->string('CCUsername')->nullable(true);
            $table->string('SCHOUsername')->nullable(true);
            $table->foreign('CHOUsername')->references('username')->on('Covid19HealthOfficer')->cascadeOnUpdate();
            $table->foreign('SCHOUsername')->references('username')->on('SenCovid19HealthOfficer')->cascadeOnUpdate();
            $table->foreign('CCUsername')->references('username')->on('Covid19Consultant')->cascadeOnUpdate();
            $table->foreign('staffUsername')->references('staffUsername')->on('Staff')->cascadeOnUpdate();
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
        Schema::dropIfExists('Salary');
    }
}
