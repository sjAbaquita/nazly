<?php

use App\Enums\PostPrivacy;
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
			$table->string('firstname', length: 30)->after('name');
			$table->string('lastname', length: 30)->after('firstname');
            $table->enum('default_privacy', PostPrivacy::cases())->default(PostPrivacy::Public->value)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('default_privacy');
        });
    }
};
