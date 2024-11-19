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
        Schema::create('shipment_mail_details', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->string('uid')->unique();
            $table->string('to')->nullable();
            $table->string('from')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->string('sender')->nullable();
            $table->integer('attach_count')->nullable();
            $table->text('attachment_paths')->nullable();
            $table->string('bkg_no')->nullable();
            $table->string('unique_mail_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_mail_details');
    }
};
