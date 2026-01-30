<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pricing_months', function (Blueprint $table) {
            $table->id('id_pricingmonth');
            $table->decimal('fee', 15, 2);
            $table->enum('status', ['enable', 'nonactive'])->default('enable');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pricing_months');
    }
};
