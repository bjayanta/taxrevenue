<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('tin_number')->unique();
            $table->string('old_tin_number')->unique()->nullable();
            $table->date('tin_date');
            $table->unsignedBigInteger('circle_id');
            $table->timestamps();

            $table->foreign('circle_id')
                  ->references('id')
                  ->on('circles')
                  ->onUpdate('cascade')
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
        Schema::dropIfExists('assessees');
    }
}
