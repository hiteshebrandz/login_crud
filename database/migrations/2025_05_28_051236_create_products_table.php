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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Assuming products belong to users
        $table->string('name');
        $table->decimal('price', 8, 2);
        $table->integer('quantity');
        $table->string('image_path');
        $table->string('video_path');
        $table->string('pdf_path');
        $table->timestamps();

        // Optional: Add foreign key constraint
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
