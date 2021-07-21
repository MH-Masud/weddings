<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('logo')->nullable();
            $table->string('working_day')->nullable();
            $table->string('working_hour')->nullable();
            $table->string('app_store_link')->nullable();
            $table->string('play_store_link')->nullable();
            $table->json('social_links')->nullable();
            $table->json('smtp_settings')->nullable();
            $table->json('term_conditions')->nullable();
            $table->json('privacy_policy')->nullable();
            $table->json('google_map')->nullable();
            $table->enum('smtp_status', ['yes', 'no'])->nullable();
            $table->enum('admin_approval', ['yes', 'no'])->nullable();
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
        Schema::dropIfExists('company_settings');
    }
}
