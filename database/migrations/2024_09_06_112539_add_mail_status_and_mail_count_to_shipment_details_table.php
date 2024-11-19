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
        Schema::table('shipment_details', function (Blueprint $table) {
            $table->integer('mail_read_status')->default(1)->nullable(); // Add mail_read_status column
            $table->integer('mail_count')->default(0)->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipment_details', function (Blueprint $table) {
            $table->dropColumn('mail_read_status'); // Remove mail_read_status column
            $table->dropColumn('mail_count'); // Remove mail_count column
        });
    }
};
