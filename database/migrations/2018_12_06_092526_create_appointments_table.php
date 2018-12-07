<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable();
            $table->date('sst')->nullable();
            $table->string('sst_reference_no')->nullable();
            $table->decimal('contract_value', 12, 2)->nullable();
            $table->string('ssm_no')->nullable();
            $table->string('ssm_reference_no')->nullable();
            $table->date('ssm_start_date')->nullable();
            $table->date('ssm_end_date')->nullable();
            $table->string('mof_no')->nullable();
            $table->string('mof_reference_no')->nullable();
            $table->date('mof_start_date')->nullable();
            $table->date('mof_end_date')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_tel')->nullable();
            $table->string('company_fax')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
