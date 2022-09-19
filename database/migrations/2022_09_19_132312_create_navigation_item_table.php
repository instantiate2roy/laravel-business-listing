<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nav_code')->nullable();
            $table->string('nav_name')->nullable();
            $table->string('nav_url')->nullable();
            $table->string('nav_menu')->nullable();
            $table->string('nav_fa_fa_icon')->nullable();
            $table->string('nav_status')->nullable();
            $table->unique(['nav_code', 'nav_menu']);
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
        Schema::dropIfExists('navigation_items');
    }
}
