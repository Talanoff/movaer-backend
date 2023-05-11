<?php

use App\Models\Vehicle;
use App\Models\Vendor;
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
        Schema::create('vendor_vehicles', static function (Blueprint $table) {
            $table->foreignIdFor(Vendor::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Vehicle::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_vehicles');
    }
};
