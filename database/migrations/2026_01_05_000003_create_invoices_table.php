<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->decimal('total', 15, 2);
            $table->string('status');
            $table->dateTime('due_date');
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('invoices');
    }
};
