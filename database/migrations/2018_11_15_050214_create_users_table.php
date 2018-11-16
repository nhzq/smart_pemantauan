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
            $table->string('ic')->unique();
            $table->integer('lookup_department_id')->unsigned();
            $table->integer('lookup_section_id')->unsigned()->nullable();
            $table->integer('lookup_unit_id')->unsigned()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lookup_department_id')
                ->references('id')->on('lookup_departments')
                ->onDelete('cascade');

            $table->foreign('lookup_section_id')
                ->references('id')->on('lookup_sections')
                ->onDelete('cascade');

            $table->foreign('lookup_unit_id')
                ->references('id')->on('lookup_units')
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
        Schema::dropIfExists('users');
    }
}
