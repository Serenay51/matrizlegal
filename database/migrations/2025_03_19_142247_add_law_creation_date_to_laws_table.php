<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('laws', function (Blueprint $table) {
            $table->date('law_creation_date')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('laws', function (Blueprint $table) {
            $table->dropColumn('law_creation_date');
        });
    }
    
};
