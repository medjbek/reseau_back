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
        Schema::create('annonces', function (Blueprint $table) {
             $table->id();

        $table->string('title');
        $table->text('description');

        $table->unsignedBigInteger('category_id');

        $table->string('organisation_name');
        $table->string('organisation_address');
        $table->string('city');

        $table->string('contact_email')->nullable();
        $table->string('contact_phone')->nullable();

        $table->string('status')->default('pending');

        $table->unsignedBigInteger('user_id');

        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('categories');
        $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
