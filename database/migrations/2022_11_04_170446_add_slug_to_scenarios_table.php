<?php

use App\Models\Scenario;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Scenario::truncate();
        Schema::table('scenarios', function (Blueprint $table) {
            $table->string('slug')->index();
        });
    }

    public function down()
    {
        Schema::table('scenarios', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
