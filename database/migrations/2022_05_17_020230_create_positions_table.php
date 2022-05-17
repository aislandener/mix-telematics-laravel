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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('PositionId')->index();
            $table->bigInteger('AssetId');
            $table->bigInteger('DriverId');
            $table->timestamp('Timestamp');
            $table->double('Latitude')->nullable();
            $table->double('Longitude')->nullable();
            $table->double('SpeedKilometresPerHour')->nullable();
            $table->double('SpeedLimit')->nullable();
            $table->double('AltitudeMetres')->nullable();
            $table->double('Heading')->nullable();
            $table->double('NumberOfSatellites')->nullable();
            $table->double('Hdop')->nullable();
            $table->double('Vdop')->nullable();
            $table->double('Pdop')->nullable();
            $table->double('AgeOfReadingSeconds')->nullable();
            $table->double('DistanceSinceReadingKilometres')->nullable();
            $table->double('OdometerKilometres')->nullable();
            $table->string('FormattedAddress')->nullable();
            $table->string('Source')->nullable();
            $table->boolean('IsAvl')->nullable();
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
        Schema::dropIfExists('positions');
    }
};
