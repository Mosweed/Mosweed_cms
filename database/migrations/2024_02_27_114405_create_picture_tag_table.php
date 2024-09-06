<?php

// create_picture_tag_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePictureTagTable extends Migration
{
    public function up()
    {
        Schema::create('picture_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('picture_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('picture_tag');
    }
}
