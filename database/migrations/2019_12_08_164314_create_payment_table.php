<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedInteger('stallowner_id');
            $table->integer('payment_number');
            $table->decimal('rental_fee');
            $table->decimal('good_will_money')->nullable();
            $table->decimal('garbage_fee');
            $table->decimal('penalty')->nullable();
            $table->date('duedate');
            $table->decimal('total_amount');
            $table->string('official_receipt_no')->nullable();
            $table->string('cashier_name');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('stallowner_id')
                    ->references('id')->on('stallowners')
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
        Schema::dropIfExists('payments');
    }
}
