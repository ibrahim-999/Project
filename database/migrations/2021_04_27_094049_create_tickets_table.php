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
            $table->id();
            $table->string('name');
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();//التاجر
            $table->enum('age',['أطفال', 'بالغين'])->default('بالغين');
            $table->longText('information')->nullable();
            $table->decimal('price_without_vat',8,2)->default(0);
            $table->decimal('price',8,2)->default(0); 
            $table->boolean('vat')->default(0);
            $table->longText('desc')->nullable();
            $table->date('date_party');
            $table->string('hour_party')->default('0');
            $table->integer('qty')->default(0);

            $table->string('image')->default('no-image.jpg');
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
