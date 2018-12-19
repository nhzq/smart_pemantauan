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
            $table->integer('allocation_id')->unsigned()->nullable();
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
            $table->text('scope')->nullable();
            $table->string('project_status')->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->string('year')->nullable();
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
