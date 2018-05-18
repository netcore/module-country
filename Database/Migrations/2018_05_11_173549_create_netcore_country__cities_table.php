<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreCountryCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_country__cities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->string('zip_code')->nullable();

            $table->foreign('country_id')->references('id')->on('netcore_country__countries')->onDelete('CASCADE');
        });

        Schema::create('netcore_country__city_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id');
            $table->string('locale', 2);
            $table->string('name');

            $table->unique(['city_id', 'locale']);
            $table->foreign('city_id')->references('id')->on('netcore_country__cities')->onDelete('CASCADE');
            $table->foreign('locale')->references('iso_code')->on('languages')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('netcore_country__city_translations');
        Schema::dropIfExists('netcore_country__cities');
    }
}
