<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocation_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('approval_date')->nullable();
            $table->string('approval_letter_ref_no')->nullable();
            $table->string('warrant_no')->nullable();
            $table->date('warrant_date')->nullable();
            $table->integer('budget_type_id')->unsigned()->nullable();
            $table->integer('from_sub_type_id')->unsigned()->nullable();
            $table->integer('to_sub_type_id')->unsigned()->nullable();
            $table->decimal('transfer_amount', 19, 2)->nullable();
            // $table->decimal('verify_transfer_amount', 19, 2)->nullable();
            $table->text('purpose')->nullable();
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
        Schema::dropIfExists('allocation_transfers');
    }
}
