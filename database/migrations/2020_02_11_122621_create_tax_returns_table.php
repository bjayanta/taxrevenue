<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('assessee_id');
            $table->unsignedBigInteger('tax_session_id');
            $table->unsignedBigInteger('circle_id');
            $table->decimal('amount', 20, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('assessee_id')
                  ->references('id')
                  ->on('assessees')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('circle_id')
                  ->references('id')
                  ->on('circles')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('tax_session_id')
                ->references('id')
                ->on('tax_sessions')
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
        Schema::dropIfExists('tax_returns');
    }
}
