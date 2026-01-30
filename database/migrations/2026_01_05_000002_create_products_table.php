<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
              $table->id();
              $table->foreignId('product_group_id')->nullable()->constrained('product_groups')->nullOnDelete(); // Grup Produk
              $table->string('product_code')->nullable()->unique(); // ID Produk
              $table->string('name');
              $table->string('slug')->unique(); // URL/slug
              $table->text('description')->nullable();
              $table->decimal('price', 15, 2);
              $table->string('type')->nullable(); // Tipe produk
              $table->foreignId('module_id')->nullable()->constrained('modules')->nullOnDelete(); // Module
              $table->string('status')->default('active');
              $table->boolean('is_hidden')->default(false); // Untuk superadmin
              $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('products');
    }
};
