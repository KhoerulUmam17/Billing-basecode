<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // USD, IDR, JPY, etc
            $table->string('prefix', 10)->nullable(); // Rp., $, etc
            $table->string('suffix', 10)->nullable(); // for example, 'Y' for JPY
            $table->string('format', 20)->nullable(); // 1,234.56 or 1.234,56
            $table->decimal('base_rate', 15, 5)->default(1.00000); // base conversion rate
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('currencies');
    }
};
