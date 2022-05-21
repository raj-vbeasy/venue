<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('performance_location_id');
            $table->foreign('performance_location_id')->references('id')->on('performance_locations');
            $table->string('name');
            $table->integer('capacity')->default(0);
            $table->string('calendar_color')->default('#4a5577');
            $table->unsignedTinyInteger('status')->default(0)->comment('0 => inactive, 1 => active');
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
        Schema::dropIfExists('stages');
    }
}
