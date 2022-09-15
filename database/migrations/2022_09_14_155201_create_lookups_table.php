<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('lk_key');
            $table->string('lk_scope');
            $table->mediumText('lk_short_description')->nullable();
            $table->longText('lk_full_description')->nullable();
            $table->string('lk_category1')->nullable();
            $table->string('lk_category2')->nullable();
            $table->string('lk_category3')->nullable();
            $table->string('lk_category4')->nullable();
            $table->string('lk_category5')->nullable();
            $table->softDeletes('deleted_at');
            $table->unique(['lk_key', 'lk_scope']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lookups');
    }
}
