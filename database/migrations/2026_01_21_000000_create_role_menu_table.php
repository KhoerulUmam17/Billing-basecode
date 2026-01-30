<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('menu');
            $table->boolean('can_access')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_menu');
    }
};
