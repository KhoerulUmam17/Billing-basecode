<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('product_groups', function (Blueprint $table) {
            $table->string('url')->nullable()->after('description');
        });
    }
    public function down() {
        Schema::table('product_groups', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
};
