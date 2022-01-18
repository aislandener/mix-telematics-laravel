<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
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
            $table->bigInteger('AssetId')->index();
            $table->string('CreatedDate');
            $table->boolean('IsConnectedTrailer');
            $table->bigInteger('AssetTypeId');
            $table->bigInteger('SiteId');
            $table->boolean('IsDefaultImage');
            $table->string('EngineHours');
            $table->double('Odometer');
            $table->bigInteger('FmVehicleId');
            $table->bigInteger('DefaultDriverId');
            $table->float('TargetFuelConsumption');
            $table->string('Country');
            $table->string('CreatedBy');
            $table->string('UserState');
            $table->text('AssetImageUrl');
            $table->string('AssetImage');
            $table->string('IconColour');
            $table->string('Icon');
            $table->string('Notes');
            $table->string('AdditionalMobileDevice');
            $table->string('EngineNumber');
            $table->string('VinNumber');
            $table->string('Year');
            $table->string('Model');
            $table->string('Make');
            $table->string('FleetNumber');
            $table->string('TargetHourlyFuelConsumptionUnits');
            $table->string('TargetFuelConsumptionUnits');
            $table->string('FuelType');
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
}
