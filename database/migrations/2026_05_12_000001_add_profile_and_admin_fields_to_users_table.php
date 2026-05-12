<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('social_id')->nullable()->after('password');
            $table->string('social_provider')->nullable()->after('social_id');
            $table->boolean('is_admin')->default(false)->after('social_provider');
            $table->timestamp('blocked_at')->nullable()->after('is_admin');

            $table->index(['social_provider', 'social_id']);
            $table->index('blocked_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['social_provider', 'social_id']);
            $table->dropIndex(['blocked_at']);
            $table->dropColumn([
                'phone',
                'social_id',
                'social_provider',
                'is_admin',
                'blocked_at',
            ]);
        });
    }
};
