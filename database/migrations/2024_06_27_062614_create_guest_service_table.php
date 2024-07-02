<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guest_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')
                ->constrained('guests')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('service_id')
                ->constrained('services')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();

            $table->unique(['guest_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('guest_services');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
