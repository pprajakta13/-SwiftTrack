<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();

            $table->string('tracking_number')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('sender_name');
            $table->string('sender_phone');
            $table->text('sender_address');

            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->text('receiver_address');

            $table->string('parcel_type');
            $table->decimal('weight', 8, 2);

            $table->string('current_status')->default('Booked');

            $table->date('estimated_delivery_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};