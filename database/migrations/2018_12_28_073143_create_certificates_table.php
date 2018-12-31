<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable();
            $table->text('definition')->nullable();
            $table->text('details')->nullable();
            $table->date('witness_date')->nullable();
            $table->string('witness_officer_name')->nullable();
            $table->string('witness_name')->nullable();
            $table->string('witness_ic')->nullable();
            $table->string('witness_address')->nullable();
            $table->date('contractor_date')->nullable();
            $table->string('contractor_name')->nullable();
            $table->string('contractor_ic')->nullable();
            $table->text('contractor_address')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('active')->unsigned()->nullable();
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
        Schema::dropIfExists('certificates');
    }
}
