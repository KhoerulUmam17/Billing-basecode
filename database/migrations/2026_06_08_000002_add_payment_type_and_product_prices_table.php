<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('products', function (Blueprint $table) {
            $table->enum('payment_type', ['free', 'onetime', 'recurring'])->default('free')->after('price');
        });
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('currency', 10); // USD, IDR, JPY
            $table->enum('period', ['onetime', 'monthly', 'quarterly', 'semiannually', 'annually', 'biennially', 'triennially'])->default('onetime');
            $table->decimal('setup_fee', 15, 2)->default(0);
            $table->decimal('price', 15, 2)->default(0);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });
        Schema::dropIfExists('product_prices');
    }
};
