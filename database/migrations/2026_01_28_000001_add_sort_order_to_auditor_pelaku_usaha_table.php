<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('auditor_pelaku_usaha', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('auditor_id');
        });

        // Backfill sort_order per pelaku_usaha based on existing insertion order
        $rows = DB::table('auditor_pelaku_usaha')
            ->select('id', 'pelaku_usaha_id')
            ->orderBy('pelaku_usaha_id')
            ->orderBy('id')
            ->get();

        $currentPelaku = null;
        $index = 0;

        foreach ($rows as $row) {
            if ($currentPelaku !== $row->pelaku_usaha_id) {
                $currentPelaku = $row->pelaku_usaha_id;
                $index = 0;
            }

            DB::table('auditor_pelaku_usaha')
                ->where('id', $row->id)
                ->update(['sort_order' => $index]);

            $index++;
        }
    }

    public function down(): void
    {
        Schema::table('auditor_pelaku_usaha', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
