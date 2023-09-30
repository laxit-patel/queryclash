<?php

use App\Enums\PromptLevel;
use App\Enums\PromptType;
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
        Schema::create('prompts', function (Blueprint $table) {
            $table->id();
            $table->text('prompt');
            $table->enum('level', PromptLevel::all())->default(PromptLevel::MEDIUM);
            $table->enum('type', PromptType::all())->default(PromptType::INSERT);
            $table->text('expect');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }
};
