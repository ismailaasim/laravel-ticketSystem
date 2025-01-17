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
        Schema::create('email_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->unique();
            $table->string('subject')->nullable();
            $table->string('from')->nullable();
            $table->string('cc')->nullable();
            $table->string('to')->nullable();
            $table->string('bcc')->nullable();
            $table->text('body')->nullable();
            $table->timestamp('received_at');
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
        Schema::dropIfExists('email_trackings');
    }
};
