<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProfitColumnsInFinancialReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financial_reports', function (Blueprint $table) {
            // Sửa đổi kiểu dữ liệu của các cột 'profit_before_tax' và 'profit_after_tax'
            $table->decimal('profit_before_tax', 15, 2)->change();
            $table->decimal('profit_after_tax', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financial_reports', function (Blueprint $table) {
            // Khôi phục lại kiểu dữ liệu ban đầu nếu cần
            $table->decimal('profit_before_tax', 10, 2)->change();
            $table->decimal('profit_after_tax', 10, 2)->change();
        });
    }
}

