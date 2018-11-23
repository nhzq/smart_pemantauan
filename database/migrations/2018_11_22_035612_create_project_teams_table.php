<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('lookup_project_team_id')->unsigned()->nullable();
            $table->integer('lookup_project_role_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('group')->nullable();
            $table->string('unit')->nullable();
            $table->integer('total_meeting')->nullable();
            $table->string('meeting_dates')->nullable();
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
        Schema::dropIfExists('project_teams');
    }
}
