<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User2Modifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {


        $table->unsignedInteger('city_id');
        $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        $table->unsignedInteger('service_id')->nullable();
        $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        $table->boolean('is_active')->default(1);

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
}
