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
     Schema::create('demande_conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->integer('nombre_jrs');
            $table->foreignId('remplacement_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('reason');
            $table->enum('status', ['pending', 'accepted', 'refused'])->default('pending');
            $table->enum('type', ['conge annuel', 'conge maladie', 'conge maternite', 'autre'])->default('autre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_conges');
    }
};
