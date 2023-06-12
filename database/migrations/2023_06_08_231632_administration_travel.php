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
        Schema::create('administration_travels', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('user_id');
            $table->string('transaction_name');
            $table->string('passport');
            $table->string('travel_code');
            $table->string('covid_data');
            $table->string('price_values');
            $table->string('warning_annotation');
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
        //
    }
};
