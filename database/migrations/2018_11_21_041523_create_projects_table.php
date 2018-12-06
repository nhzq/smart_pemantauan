<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('file_reference_no')->nullable();
            $table->text('concept')->nullable();
            $table->decimal('estimate_cost', 19, 2)->nullable();
            $table->date('approval_date')->nullable();
            $table->integer('lookup_budget_type_id')->unsigned()->nullable();
            $table->integer('lookup_sub_budget_type_id')->unsigned()->nullable();
            $table->text('rmk')->nullable();
            $table->integer('market_research')->unsigned()->nullable();
            $table->text('objective')->nullable();
            $table->date('minute_approval_date')->nullable();
            $table->date('approval_pwn_date')->nullable();
            $table->integer('lookup_collection_type_id')->nullable();
            $table->integer('verified_by')->unsigned()->nullable();
            $table->date('verification_date')->nullable();
            $table->string('collection_file_no')->nullable();
            $table->date('collection_open_date')->nullable();
            $table->date('collection_close_date')->nullable();
            $table->integer('duration')->unsigned()->nullable();
            $table->date('collection_meeting_date')->nullable();
            $table->date('actual_approval_date')->nullable();
            $table->decimal('actual_project_cost', 12, 2)->nullable();
            $table->text('justification')->nullable();
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
            $table->integer('status')->unsigned()->nullable();
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
        Schema::dropIfExists('projects');
    }
}
