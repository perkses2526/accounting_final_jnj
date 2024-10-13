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
        Schema::create('accounting_data', function (Blueprint $table) {
            $table->id();
            $table->string('company_code');
            $table->string('division_code');
            $table->string('department_code');
            $table->date('date_entered');
            $table->foreignId('source')->constrained('transaction_lists')->onDelete('cascade');
            $table->string('charts_of_accounts');
            $table->string('class');
            $table->string('sub_class');
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
            $table->string('amount');
            $table->string('currency');
            $table->date('posting_month');
            $table->text('remarks');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_data');
    }
};
