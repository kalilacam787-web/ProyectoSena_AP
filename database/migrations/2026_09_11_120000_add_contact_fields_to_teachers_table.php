<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            if (! Schema::hasColumn('teachers', 'address')) {
                $table->string('address')->nullable()->after('email');
            }

            if (! Schema::hasColumn('teachers', 'phone')) {
                $table->string('phone', 30)->nullable()->after('address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            if (Schema::hasColumn('teachers', 'address')) {
                $table->dropColumn('address');
            }

            if (Schema::hasColumn('teachers', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};