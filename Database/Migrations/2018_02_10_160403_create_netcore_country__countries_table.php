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
            $table->string('code')->index();
            $table->string('name');
            $table->string('capital');
            $table->string('full_name');
            $table->string('calling_code');
            $table->boolean('eea');
            $table->boolean('is_active')->index()->default(true);

            $table->foreign('currency_id')->references('id')->on('netcore_country__currencies')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('netcore_country__countries');
    }
}
