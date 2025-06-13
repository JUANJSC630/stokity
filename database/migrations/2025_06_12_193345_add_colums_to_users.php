<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_sucursal')->nullable()->after('id');
            $table->string('photo')->nullable();
            $table->string('last_login')->nullable();
            $table->string('status')->nullable();
            $table->string('role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id_sucursal');
            $table->dropColumn('photo');
            $table->dropColumn('last_login');
            $table->dropColumn('status');
            $table->dropColumn('role');
        });
    }
};
