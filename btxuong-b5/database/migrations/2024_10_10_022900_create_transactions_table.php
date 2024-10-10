<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique(); // Mã giao dịch duy nhất
            $table->decimal('amount', 15, 2); // Số tiền giao dịch
            $table->string('recipient_account'); // Tài khoản nhận
            $table->string('confirmation_code')->nullable(); // Mã xác nhận (có thể null cho tới khi xác nhận)
            $table->integer('step')->default(1); // Trạng thái bước hiện tại của giao dịch
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
