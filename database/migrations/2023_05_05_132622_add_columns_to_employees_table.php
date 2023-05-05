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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('designation_id')->after('phone')->nullable()->constrained('designations')->cascadeOnDelete();
            $table->string('image')->after('designation_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropForeign(['designation_id']);
            $table->dropColumn('designation_id');
        });
    }
};
