<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable();
            $table->date('sst')->nullable();
            $table->string('sst_reference_no')->nullable();
            $table->string('contract_value')->nullable();
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
            $table->integer('total_contractor')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('active')->nullable();
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
        Schema::dropIfExists('contractors');
    }
}
