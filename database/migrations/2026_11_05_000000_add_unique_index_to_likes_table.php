<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $duplicates = DB::table('likes')
            ->select('user_id', 'post_id', DB::raw('MIN(id) as keep_id'))
            ->groupBy('user_id', 'post_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            DB::table('likes')
                ->where('user_id', $duplicate->user_id)
                ->where('post_id', $duplicate->post_id)
                ->where('id', '!=', $duplicate->keep_id)
                ->delete();
        }

        Schema::table('likes', function (Blueprint $table) {
            $table->unique(['user_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'post_id']);
        });
    }
};
