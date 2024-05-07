<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('code');
            $table->string('phone')->unique();
            $table->string('identity')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('job')->nullable(); //for providers Only
            $table->string('qualifications')->nullable();//for providers Only
            $table->string('certifications')->nullable();//for providers Only
            $table->enum('role',['provider','client'])->nullable();
            $table->enum('provider_type',['one','company'])->nullable();
            $table->string('provider_company_type')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->text('bio')->nullable();
            $table->string('device_token')->nullable();
            $table->string('fcm_token_android')->nullable();
            $table->string('fcm_token_ios')->nullable();
            $table->integer('confirmation_code')->nullable();
            $table->integer('verification_code')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('general_specification')->nullable();//for providers Only
            $table->string('nano_specification')->nullable();//for providers Only
            $table->string('experience_years')->nullable();//for providers Only
            $table->string('address')->nullable();//for providers Only
            $table->string('charitable')->nullable();//for providers Only
            $table->string('delivery')->nullable();//for providers Only
            $table->string('map')->nullable();//for providers Only
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
