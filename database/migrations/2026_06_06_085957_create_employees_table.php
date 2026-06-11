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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table -> string('name');
            $table -> enum('gender',['Male', 'Female', 'Other']);
            $table -> string('phone');
            $table -> boolean('status');
            $table->text('address') -> default('Not available');
            $table -> string('city');
            $table -> string('profile_image') -> nullable();
            $table -> foreignId('user_id') -> constrained() -> cascadeOnDelete();
            $table -> foreignId('department_id') -> nullable() -> constrained() -> nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empoloyees');
    }
};
