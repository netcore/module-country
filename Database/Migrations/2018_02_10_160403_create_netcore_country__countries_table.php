<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreCountryCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_country__countries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('code')->index()->unique();
            $table->string('capital')->nullable();
            $table->string('calling_code')->nullable();
            $table->boolean('eea')->nullable();
            $table->boolean('is_active')->index()->default(true);

            $table->foreign('currency_id')->references('id')->on('netcore_country__currencies')->onDelete('SET NULL');
        });

        Schema::create('netcore_country__country_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->string('locale', 2);

            $table->string('name');
            $table->string('full_name')->nullable();

            $table->unique(['country_id', 'locale']);
            $table->foreign('country_id')->references('id')->on('netcore_country__countries')->onDelete('CASCADE');
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
        Schema::dropIfExists('netcore_country__country_translations');
        Schema::dropIfExists('netcore_country__countries');
    }
}
