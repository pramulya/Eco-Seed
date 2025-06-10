<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
<<<<<<<< HEAD:database/migrations/2025_06_01_083854_create_pings_table.php
        Schema::create('pings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('message'); // tidak lebih dari 50 kata (divalidasi di controller)
            $table->string('image_path')->nullable();
            $table->timestamps();
========
        Schema::table('volunteers', function (Blueprint $table) {
            //
>>>>>>>> Surya_branch:database/migrations/2025_05_26_055955_make_motivation_nullable_in_volunteers_table.php
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2025_06_01_083854_create_pings_table.php
        Schema::dropIfExists('pings');
========
        Schema::table('volunteers', function (Blueprint $table) {
            //
        });
>>>>>>>> Surya_branch:database/migrations/2025_05_26_055955_make_motivation_nullable_in_volunteers_table.php
    }
};
