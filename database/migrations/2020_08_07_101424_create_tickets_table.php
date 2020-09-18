<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('location_id');
            $table->integer('terminal');
            $table->float('pay_in', 15, 2);
            $table->float('win', 15, 2);
            $table->float('difference', 15, 2);
            $table->float('pay_out', 15, 2);
            $table->float('balance', 15, 2);
            $table->float('storno', 15, 2);
            $table->integer('pay_in_count');
            $table->integer('pay_out_count');
            $table->integer('storno_count');
            $table->string('ccy');
            $table->integer('win_count');
            $table->float('win_tax_amount', 15, 2);
            $table->string('source');
            $table->date('date');
            $table->float('payoutUntaxed', 15, 2);
            $table->float('paymentTax', 15, 2);

            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
