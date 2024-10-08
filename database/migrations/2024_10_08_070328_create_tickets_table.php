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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('user_code');
            $table->date('date_entered')->nullable();
            $table->foreignId('transaction_id')->constrained('transaction_lists')->onDelete('cascade');
            $table->string('reference_no');
            $table->text('remarks')->nullable();
            $table->string('status')->nullable();
            $table->date('date_status_updated')->nullable();;
            $table->string('reason_if_denied')->nullable();
            $table->date('expiry_date_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
