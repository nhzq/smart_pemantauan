<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lookup_department_id')->unsigned()->nullable();
            $table->integer('lookup_budget_type_id')->unsigned()->nullable();
            $table->integer('lookup_sub_budget_type_id')->unsigned()->nullable();
            $table->decimal('amount', 19, 2)->nullable();
            $table->decimal('estimate_cost', 19, 2)->nullable();
            $table->decimal('project_cost', 19, 2)->nullable();
            $table->decimal('total_spending', 19, 2)->nullable();
            $table->decimal('balance', 19, 2)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('allocations');
    }
}
