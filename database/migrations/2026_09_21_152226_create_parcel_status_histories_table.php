<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parcel_status_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parcel_id')
                ->constrained('parcels')
                ->onDelete('cascade');

            $table->string('status');

            $table->string('location')->nullable();

            $table->text('remarks')->nullable();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcel_status_histories');
    }
};