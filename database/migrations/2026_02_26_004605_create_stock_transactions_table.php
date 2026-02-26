<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // IN / OUT
            $table->enum('type', ['IN', 'OUT']);
            $table->unsignedInteger('qty');

            // ملاحظات اختيارية (سبب العملية/فاتورة..)
            $table->string('note')->nullable();

            // كمية المنتج قبل وبعد العملية (مفيد للتدقيق والتقارير)
            $table->unsignedInteger('before_qty');
            $table->unsignedInteger('after_qty');

            $table->timestamps();

            $table->index(['product_id', 'type', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};