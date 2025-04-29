<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration {
    public function up(): void
    {

        // Users table migration
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('surname', 25)->after('name');
            $table->string('username', 25)->unique()->after('surname');
            $table->enum('role', ['admin', 'user', 'guest'])->default('guest')->after('password');
            $table->softDeletes()->after('updated_at'); // includes deleted_at
            $table->timestamp('last_login')->nullable()->after('softDeletes');
        });

        // Products, Authors, Carts, and Cart_Product tables migration
        // Products table
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 100);
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->enum('category', [
                'fantasy', 'sci-fi', 'mystery', 'romance', 'horror',
                'non-fiction', 'biography', 'self_help', 'education',
                'fitness', 'psychology', 'adults'
            ]);
            $table->timestamps();
        });

        // Authors table
        Schema::create('authors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->date('birth_date');
            $table->text('biography');
            $table->timestamps();
        });

        // Reference table for many-to-many relationship between products and authors
        Schema::create('product_authors', function (Blueprint $table) {
            $table->uuid('product_id');
            $table->uuid('author_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->timestamps();
        });

        // Carts table
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });

        // Refference table for many-to-many relationship between carts and products
        Schema::create('cart_products', function (Blueprint $table) {
            $table->uuid('cart_id');
            $table->uuid('product_id');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        //** Order-related part */
        // Orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('delivery_method', ['standard', 'express', 'overnight', 'pickup', 'same_day', 'in_store_pickup']);
            $table->enum('payment_method', ['credit_card', 'debit_card','paypal', 'bank_transfer', 'cash_on_delivery']);
            $table->decimal('price', 10, 2);
            $table->string('delivery_address', 255);
            $table->string('billing_address', 255);
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('expedition_date')->nullable();
            $table->timestamps();
        });

        // Reference table for many-to-many relationship between orders and users
        Schema::create('user_orders', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('order_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });

        // Refference table for many-to-many relationship between orders and products
        Schema::create('order_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('product_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_orders');
        Schema::dropIfExists('product_authors');
        Schema::dropIfExists('cart_products');
        Schema::dropIfExists('order_products');

        Schema::dropIfExists('orders');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('products');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['surname', 'role', 'id']);
            $table->id(); // Restore default autoincrement ID
        });
    }
};
