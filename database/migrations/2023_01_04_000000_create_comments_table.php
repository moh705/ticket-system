<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id'); // Colonne ticket_id ajoutée
            $table->unsignedBigInteger('user_id'); // Colonne user_id ajoutée
            $table->text('content');
            $table->boolean('is_internal')->default(false);
            $table->timestamps();

            // Index pour améliorer les performances
            $table->index(['ticket_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}