<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lookup_budget_type_id')->unsigned()->nullable();
            $table->decimal('amount', 19, 2)->nullable();
            $table->decimal('extra_budget', 19, 2)->nullable();
            $table->string('extra_budget_from')->nullable();
            $table->date('extra_budget_date')->nullable();
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
        Schema::dropIfExists('provisions');
    }
}
