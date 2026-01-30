<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('method');
            $table->string('transaction_id')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('payments');
    }
};
