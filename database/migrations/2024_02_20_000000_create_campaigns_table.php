<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->string('campaign_type');
            $table->string('campaign_category');
            $table->string('campaign_organizer');
            $table->date('campaign_start_date');
            $table->date('campaign_end_date');
            $table->decimal('campaign_target', 10, 2);
            $table->text('campaign_description');
            $table->string('image_path')->nullable();
            $table->integer('year');
            $table->decimal('current_amount', 10, 2)->default(0);
            $table->integer('volunteer_count')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};