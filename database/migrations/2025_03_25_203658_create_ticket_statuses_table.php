<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insérer des données initiales
        \App\Models\TicketStatus::insert([
            ['name' => 'Open', 'description' => 'Le ticket est ouvert et en attente de traitement'],
            ['name' => 'In Progress', 'description' => 'Le ticket est en cours de traitement'],
            ['name' => 'Resolved', 'description' => 'Le ticket a été résolu'],
            ['name' => 'Closed', 'description' => 'Le ticket a été fermé'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('ticket_statuses');
    }
}