<?php

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_project', function (Blueprint $table) {
            $table->foreignIdFor(Client::class);
            $table->foreignIdFor(Project::class);
            $table->primary(['client_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_project', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['project_id']);
        });
        Schema::dropIfExists('client_project');
    }
};
