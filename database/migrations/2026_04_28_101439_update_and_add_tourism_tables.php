<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat tabel baru (jika belum ada)
        $tables = ['culinaries', 'cultures', 'events'];

        foreach ($tables as $tableName) {
            if (!Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('slug')->unique();
                    $table->string('district');
                    $table->text('description_id');
                    $table->text('description_en')->nullable();
                    $table->string('thumbnail')->nullable();
                    $table->timestamps();
                });
            }
        }

        // 2. Karena description SUDAH jadi description_id, kita cukup tambah description_en
        Schema::table('destinations', function (Blueprint $table) {
            if (!Schema::hasColumn('destinations', 'description_en')) {
                $table->text('description_en')->after('description_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('culinaries');
        Schema::dropIfExists('cultures');
        Schema::dropIfExists('events');

        Schema::table('destinations', function (Blueprint $table) {
            $table->renameColumn('description_id', 'description');
            $table->dropColumn('description_en');
        });
    }
};