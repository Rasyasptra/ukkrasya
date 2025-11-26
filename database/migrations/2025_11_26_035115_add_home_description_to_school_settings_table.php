<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->text('home_description')->nullable()->after('school_email');
        });

        // Set default value for existing records
        $settings = DB::table('school_settings')->first();
        if ($settings && is_null($settings->home_description)) {
            DB::table('school_settings')->where('id', $settings->id)->update([
                'home_description' => 'Membangun generasi yang kompeten, berkarakter, dan siap menghadapi tantangan masa depan melalui pendidikan berkualitas dan teknologi terkini.',
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->dropColumn('home_description');
        });
    }
};
