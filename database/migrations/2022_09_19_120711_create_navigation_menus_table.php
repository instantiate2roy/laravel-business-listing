<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('menu_code')->nullable();
            $table->string('menu_name')->nullable();
            $table->string('menu_status')->nullable();
            $table->unique('menu_code');
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigation_menus');
    }
}
