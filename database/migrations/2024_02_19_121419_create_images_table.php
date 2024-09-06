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
        Schema::create(
            'pictures', function (Blueprint $table) {
                $table->id();
                $table->string('fileTitle');
                $table->string('fileName');
                $table->string('originalName');
                $table->integer('fileSize');
                $table->integer('originalFileSize')->nullable();
                $table->decimal('compressionRatio', 5, 2)->nullable();
                $table->string('altText')->nullable();
                $table->string('originalPath')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
