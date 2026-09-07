<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('document_number')->nullable()->unique()->after('name');
            $table->string('access_code')->nullable()->unique()->after('email');
        });

        Schema::table('apprentices', function (Blueprint $table) {
            $table->string('document_number')->nullable()->unique()->after('name');
            $table->string('password')->nullable()->after('email');
        });

        Schema::table('computers', function (Blueprint $table) {
            $table->string('assigned_name')->nullable()->after('brand');
            $table->string('assigned_document')->nullable()->after('assigned_name');
            $table->string('assigned_email')->nullable()->after('assigned_document');
            $table->unique('number');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->string('name')->nullable()->after('course_number');
            $table->string('schedule')->nullable()->after('day');
            $table->unsignedTinyInteger('duration_months')->nullable()->after('schedule');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropUnique(['document_number']);
            $table->dropUnique(['access_code']);
            $table->dropColumn(['document_number', 'access_code']);
        });

        Schema::table('apprentices', function (Blueprint $table) {
            $table->dropUnique(['document_number']);
            $table->dropColumn(['document_number', 'password']);
        });

        Schema::table('computers', function (Blueprint $table) {
            $table->dropUnique(['number']);
            $table->dropColumn(['assigned_name', 'assigned_document', 'assigned_email']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['name', 'schedule', 'duration_months']);
        });
    }
};
