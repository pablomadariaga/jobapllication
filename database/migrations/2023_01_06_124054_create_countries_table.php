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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('native')->unique();
            $table->string('iso2', 15);
            $table->string('iso3', 15);
            $table->integer('numeric_code');
            $table->string('phone_code', 20);
            $table->string('currency', 15);
            $table->string('currency_name', 150);
            $table->string('currency_symbol', 15);
            $table->string('region', 100);
            $table->string('emoji', 100);
            $table->string('emojiU', 100);
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
        Schema::dropIfExists('countries');
    }
};
