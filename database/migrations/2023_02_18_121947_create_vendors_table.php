<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', static function (Blueprint $table) {
            $table->id();
            $table->char('nano_id', 8)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('iban');
            $table->string('vat');
            $table->string('commerce_no')->nullable();
            $table->string('post_code');
            $table->text('address');
            $table->text('about')->nullable();
            $table->string('employees')->nullable();
            $table->double('rating', 2, 1)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
