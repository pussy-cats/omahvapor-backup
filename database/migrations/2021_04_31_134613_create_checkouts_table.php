<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->integer('pay')->nullable();
            $table->integer('change')->nullable();
            $table->string('courier')->nullable();
            $table->text('address')->nullable();
            $table->integer('deliveryfee')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('schedule_id')->nullable()->constrained();
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
        Schema::dropIfExists('checkouts');
    }
}