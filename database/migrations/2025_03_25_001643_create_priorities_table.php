<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrioritiesTable extends Migration
{
    public function up()
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('color')->nullable();
            $table->integer('level')->unsigned()->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        // Insérer des données initiales
        \App\Models\Priority::insert([
            ['name' => 'Faible', 'color' => '#00FF00', 'level' => 1],
            ['name' => 'Moyenne', 'color' => '#FFFF00', 'level' => 2],
            ['name' => 'Élevée', 'color' => '#FFA500', 'level' => 3],
            ['name' => 'Critique', 'color' => '#FF0000', 'level' => 4],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('priorities');
    }
}