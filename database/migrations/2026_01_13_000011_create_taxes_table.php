<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['include', 'exclude'])->default('include');
            $table->decimal('rate', 5, 2)->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('taxes');
    }
};
