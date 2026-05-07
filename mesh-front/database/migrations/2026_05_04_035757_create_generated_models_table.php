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
        Schema::create('generated_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('prompt');
            $table->string('object_type')->nullable();
            $table->string('filename')->nullable();
            $table->string('file_path')->nullable();
            $table->text('download_url')->nullable();
            $table->string('units')->default('mm');
            $table->json('bbox')->nullable();
            $table->decimal('max_dimension_mm', 10, 2)->nullable();
            $table->decimal('volume_mm3', 15, 2)->nullable();
            $table->integer('triangle_count')->nullable();
            $table->boolean('watertight')->default(false);
            $table->boolean('winding_consistent')->default(false);
            $table->boolean('manifold')->nullable();
            $table->string('print_type')->nullable();
            $table->string('material')->nullable();
            $table->boolean('hollowed')->default(false);
            $table->decimal('wall_thickness_mm', 8, 2)->nullable();
            $table->string('orientation')->nullable();
            $table->json('api_response')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_models');
    }
};
