<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('role_code')->nullable();
            $table->string('role_name')->nullable();
            $table->integer('role_rank')->nullable();
            $table->string('role_group')->nullable();
            $table->string('role_status')->nullable();
            $table->string('deleted_at')->nullable();
            $table->unique(['role_code']);
            $table->unique(['role_rank','role_group']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
