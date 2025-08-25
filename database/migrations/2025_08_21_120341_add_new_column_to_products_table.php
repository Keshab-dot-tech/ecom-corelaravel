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
        Schema::table('products', function (Blueprint $table) {
            //     $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            //     $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};


// Schema::create('products', function (Blueprint $table) {
//     $table->id();
//     $table->string('name');

//     // These are the foreign keys we’re checking
//     $table->unsignedBigInteger('category_id');
//     $table->unsignedBigInteger('brand_id');

//     $table->decimal('price', 8, 2);
//     $table->timestamps();

//     $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
//     $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
// });
