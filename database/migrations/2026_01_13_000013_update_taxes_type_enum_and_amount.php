<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        // Sudah dihandle di migrasi create_taxes_table, tidak perlu perubahan apapun di sini
    }
    public function down() {
        // Tidak ada perubahan yang perlu di-rollback
    }
};
