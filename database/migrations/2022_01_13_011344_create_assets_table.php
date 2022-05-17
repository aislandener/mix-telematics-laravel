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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('AssetId')->unique();
            $table->string('CreatedDate');
            $table->boolean('IsConnectedTrailer');
            $table->bigInteger('AssetTypeId');
            $table->bigInteger('SiteId');
            $table->boolean('IsDefaultImage');
            $table->string('EngineHours')->nullable();
            $table->double('Odometer')->nullable();
            $table->bigInteger('FmVehicleId');
            $table->bigInteger('DefaultDriverId');
            $table->float('TargetFuelConsumption')->nullable();
            $table->string('Country')->nullable();
            $table->string('CreatedBy');
            $table->string('UserState');
            $table->text('AssetImageUrl');
            $table->string('AssetImage');
            $table->string('IconColour');
            $table->string('Icon');
            $table->string('Notes')->nullable();
            $table->string('AdditionalMobileDevice')->nullable();
            $table->string('EngineNumber')->nullable();
            $table->string('VinNumber')->nullable();
            $table->string('Year')->nullable();
            $table->string('Model')->nullable();
            $table->string('Make')->nullable();
            $table->string('FleetNumber')->nullable();
            $table->string('TargetHourlyFuelConsumptionUnits');
            $table->string('TargetFuelConsumptionUnits')->nullable();
            $table->string('FuelType')->nullable();
            $table->string('RegistrationNumber');
            $table->string('Description');
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
        Schema::dropIfExists('assets');
    }
};
