<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StallOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stallowners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('address');
            $table->date('birthday');
            $table->string('class');
            $table->integer('stall_number');
            $table->decimal('area');
            $table->string('profile_image');
            $table->string('payment')->nullable();
            $table->string('uploader')->nullable();
            $table->date('contract_date');
            $table->date('expiration_date');
            $table->date('duedate');
            $table->rememberToken();
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
        Schema::dropIfExists('stallowners');
    }
}
