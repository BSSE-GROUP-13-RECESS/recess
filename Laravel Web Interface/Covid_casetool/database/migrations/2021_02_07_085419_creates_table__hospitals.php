<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatesTableHospitals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('Hospitals', function (Blueprint $table) {
            $table->bigInteger('hospitalId')->autoIncrement();
            $table->string('hospitalName')->nullable(false)->unique();
            $table->enum('Type',['National_Referral_Hospital','Regional_Referral_Hospital','General_Hospital'])->nullable(false);
        });
        DB::update("ALTER TABLE Hospitals AUTO_INCREMENT = 1;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Hospitals');
    }
}
