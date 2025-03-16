<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//test/////
class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->date('ticket_date');
            $table->integer('quantity');
            $table->String('user_category');
            $table->string('payment_type')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();
        });

        // Schema::table('carts', function (Blueprint $table) {
        //     $table->string('payment_type')->nullable()->change(); // Allow NULL values
        //     $table->date('payment_date')->nullable()->change(); // Allow NULL values
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
