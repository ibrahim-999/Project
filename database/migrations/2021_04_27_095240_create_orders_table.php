<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//ahmed
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->integer('qty');
            // $table->string('qr_code');
            $table->string('order_number')->nullable()->unique();
            $table->integer('total')->default(0);
            // $table->integer('total_price');
            $table->enum('admin_status', ['لم يتم الدفع', 'تم الدفع'])->default('لم يتم الدفع');
            $table->enum('payment_method', ['أونلاين', 'الدفع عند الاستلام'])
                ->default('الدفع عند الاستلام');
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
        Schema::dropIfExists('orders');
    }
}
