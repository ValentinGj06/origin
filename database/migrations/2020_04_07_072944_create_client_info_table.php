<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_info', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->date('birth_date');
            $table->string('phone_number')->nullable();
            $table->boolean('is_valid_phone_number')->default(false);
            $table->string('gender')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('city')->nullable();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
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
        Schema::dropIfExists('client_info');
    }
}
