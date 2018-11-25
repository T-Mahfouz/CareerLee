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
        Schema::enableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->integer('role_id')->unsigned();
            $table->integer('gender_id')->unsigned();
            $table->integer('marital_id')->unsigned();
            $table->string('nationality');
            $table->boolean('driving_license')->default(0);
            $table->boolean('status')->default(0);
            $table->string('address');
            $table->string('image');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('lang');
            $table->string('bio')->nullable();
            $table->string('code')->nullable();
            $table->string('firebase')->nullable();
            $table->boolean('job_match_notify')->default(0);
            $table->boolean('job_expired_notify')->default(0);
            $table->boolean('job_finder_notify')->default(0);
            $table->date('birth_date');
            $table->string('min_company_siz')->nullable();
            $table->string('max_company_siz')->nullable();
            $table->string('company_location')->nullable();
            
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('marital_id')->references('id')->on('maritals')->onUpdate('cascade')->onDelete('cascade');

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
