<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('training__centers') && ! Schema::hasTable('training_centers')) {
            Schema::rename('training__centers', 'training_centers');
        }

        if (Schema::hasTable('course__teachers') && ! Schema::hasTable('course_teacher')) {
            Schema::rename('course__teachers', 'course_teacher');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('course_teacher') && ! Schema::hasTable('course__teachers')) {
            Schema::rename('course_teacher', 'course__teachers');
        }

        if (Schema::hasTable('training_centers') && ! Schema::hasTable('training__centers')) {
            Schema::rename('training_centers', 'training__centers');
        }
    }
};
