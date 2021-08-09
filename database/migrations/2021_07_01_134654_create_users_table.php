<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('device_key')->nullable();
            $table->foreignId('role_id')->default(2)->constrained('roles');
            $table->foreignId('status_id')->default(1)->constrained('statuses');
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
