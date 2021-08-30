<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThroughsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('throughs', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('through')->nullable();
            $table->date('search_date');
            $table->unsignedBigInteger('count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('throughs');
    }
}
