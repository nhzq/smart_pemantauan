<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookupUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lookup_section_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('displayed_name');
            $table->timestamps();

            $table->foreign('lookup_section_id')
                ->references('id')->on('lookup_sections')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('lookup_units');
    }
}
