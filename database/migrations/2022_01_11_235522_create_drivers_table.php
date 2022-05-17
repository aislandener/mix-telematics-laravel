<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('DriverId')->unique();
            $table->string('Name');
            $table->boolean('IsSystemDriver');
            $table->bigInteger('FmDriverId');
            $table->bigInteger('SiteId');
            $table->json('AdditionalDetailFields');
            $table->string('ExtendedDriverIdType');
            $table->string('Country')->nullable();
            $table->string('EmployeeNumber')->nullable();
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
        Schema::dropIfExists('drivers');
    }
};
