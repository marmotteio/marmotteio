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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });

        Schema::create('team_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id');
            $table->string('name');
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index(['account_id', 'stripe_status']);
        });

        Schema::create('subscription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id');
            $table->string('stripe_id')->unique();
            $table->string('stripe_product');
            $table->string('stripe_price');
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->unique(['subscription_id', 'stripe_price']);
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('hardware_statuses', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->string('color')->nullable();
            $table->timestamps();
        });

        Schema::create('hardware_models', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->string('number')->nullable();
            $table->boolean('requestable')->default(true);
            $table->string('image')->nullable();

            $table->timestamps();
        });

        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name')->nullable();
            $table->string('order_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->integer('quantity')->default(1);

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('hardware_model_id');
            $table->foreign('hardware_model_id')->references('id')->on('hardware_models')->onDelete('cascade');

            $table->unsignedBigInteger('hardware_status_id');
            $table->foreign('hardware_status_id')->references('id')->on('hardware_statuses')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id')->nullable()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->date('expected_checkin_date')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('end_of_life_date')->nullable();
            $table->decimal('purchase_cost')->nullable();
            $table->boolean('requestable')->default(true);

            $table->timestamps();
        });

        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->timestamps();

            $table->string('licensed_to_name')->nullable();
            $table->string('licensed_to_email')->nullable();
            $table->string('product_key')->nullable();
            $table->string('order_number')->nullable();

            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost')->nullable();
            $table->date('expiration_date')->nullable();
            $table->date('termination_date')->nullable();

            $table->integer('quantity')->default(0);
            $table->string('name');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });

        Schema::create('consumables', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('model_number')->nullable();
            $table->string('order_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('name');
            $table->timestamps();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('manufacturer_id');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });

        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('order_number')->nullable();
            $table->string('model_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('name');
            $table->timestamps();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('manufacturer_id');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });

        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('depreciations', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->unsignedBigInteger('hardware_id');
            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('cascade');
            $table->enum('method', ['straight_line', 'double_declining', 'units_of_production']);
            $table->date('purchase_date');
            $table->decimal('purchase_price', 15, 2);
            $table->decimal('residual_value', 15, 2);
            $table->integer('useful_life_years');
            $table->decimal('depreciation_expense', 15, 2)->nullable();
            $table->decimal('accumulated_depreciation', 15, 2)->nullable();
            $table->decimal('current_book_value', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();

            $table->unsignedBigInteger('hardware_id');
            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('cascade');

            $table->date('maintenance_date')->nullable();
            $table->decimal('cost')->nullable();
            $table->string('maintenance_type')->nullable();
            $table->string('performed_by')->nullable();

            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('consumable_person', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();

            $table->timestamp('checked_out_at')->useCurrent();
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('consumable_id');

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('consumable_id')->references('id')->on('consumables')->onDelete('cascade');
        });

        Schema::create('licence_person', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();

            $table->timestamp('checked_out_at')->useCurrent();
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('licence_id');

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('licence_id')->references('id')->on('licences')->onDelete('cascade');
        });

        Schema::create('hardware_licence', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();

            $table->timestamp('checked_out_at')->useCurrent();
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('hardware_id');
            $table->unsignedBigInteger('licence_id');

            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('cascade');
            $table->foreign('licence_id')->references('id')->on('licences')->onDelete('cascade');
        });

        Schema::create('component_hardware', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();

            $table->timestamps();
            $table->timestamp('checked_out_at')->useCurrent();
            $table->timestamp('checked_in_at')->nullable();

            $table->unsignedBigInteger('hardware_id');
            $table->unsignedBigInteger('component_id');

            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
        });

        Schema::create('hardware_person', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();

            $table->timestamps();
            $table->timestamp('checked_out_at')->useCurrent();
            $table->timestamp('checked_in_at')->nullable();

            $table->unsignedBigInteger('hardware_id');
            $table->unsignedBigInteger('person_id');

            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('backups', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->timestamps();
        });

        Schema::create('consumable_models', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->timestamps();
        });

        Schema::create('licence_models', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->timestamps();
        });

        Schema::create('component_models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->json('files')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('hardware', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('manufacturers', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('components', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('consumables', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('licences', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
        });

        Schema::table('maintenances', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('depreciations', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('hardware_person', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('hardware_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('hardware_models', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('hardware_licence', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('consumable_person', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('component_hardware', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('licence_person', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('licence_models', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('component_models', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('consumable_models', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->morphs('model');
            $table->uuid('uuid')->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable()->index();

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
