<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('object');
            $table->text('amount');
            $table->string('path')->nullable();
            $table->string('fileName')->nullable();
            $table->string('status',20)->nullable();
            $table->string('responsible',20)->nullable();
            $table->string('control',20)->nullable();
            $table->string('direction',20)->nullable();
            $table->string('cashier',20)->nullable();
            $table->text('reason')->nullable();
            $table->text('token')->nullable();
            $table->string('isPaid',5)->nullable();
            $table->unsignedBigInteger('user_id')->index();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('employers');
    }
}
