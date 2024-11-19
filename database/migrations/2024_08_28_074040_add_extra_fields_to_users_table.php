<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('branch')->nullable()->collation('utf8mb4_unicode_ci');
            $table->enum('role', ['Admin', 'Manager', 'User'])->nullable()->collation('utf8mb4_unicode_ci');
            $table->text('address')->nullable()->collation('utf8mb4_unicode_ci');
            $table->longText('image')->nullable()->collation('utf8mb4_unicode_ci');
            $table->enum('gender', ['male', 'female', 'others'])->nullable()->collation('utf8mb4_unicode_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['branch', 'role', 'address', 'image', 'gender']);
        });
    }
};
