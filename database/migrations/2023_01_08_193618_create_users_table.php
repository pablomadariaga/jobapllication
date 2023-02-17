<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onUpdate('CASCADE');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('social_security', 30)->nullable();
            $table->string('present_address', 255);
            $table->string('present_state', 100);
            $table->string('present_city', 100);
            /* $table->foreignId('present_state')->nullable()->constrained('states');
            $table->foreignId('present_city')->constrained('cities'); */
            $table->string('present_zip', 20);
            $table->string('present_phone', 20);
            /* $table->string('permanent_address', 255);
            $table->foreignId('permanent_state')->nullable()->constrained('states');
            $table->string('permanent_city')->constrained('cities');
            $table->string('permanent_zip', 20);
            $table->string('permanent_phone', 20); */
            $table->string('email')->unique();
            $table->string('referred_by')->nullable();
            $table->string('position');
            $table->timestamp('start_date');
            $table->unsignedTinyInteger('employed')->default(0);
            $table->unsignedTinyInteger('applied')->default(0);
            $table->string('where_apply')->nullable();
            $table->string('when_apply')->nullable();
            $table->string('high_school')->nullable();
            $table->unsignedTinyInteger('high_school_graduate')->nullable();
            $table->string('high_school_subjects_studied')->nullable();
            $table->string('college')->nullable();
            $table->unsignedTinyInteger('college_graduate')->nullable();
            $table->string('college_subjects_studied')->nullable();
            $table->string('trade_school')->nullable();
            $table->unsignedTinyInteger('trade_school_graduate')->nullable();
            $table->string('trade_school_subjects_studied')->nullable();
            $table->string('special_study')->nullable();
            $table->string('special_training')->nullable();
            $table->string('special_skills')->nullable();
            $table->string('military')->nullable();
            $table->string('rank')->nullable();
            $table->unsignedInteger('year_1')->nullable();
            $table->unsignedInteger('month_1')->nullable();
            $table->string('name_1', 120)->nullable();
            $table->string('phone_1')->nullable();
            $table->string('position_1')->nullable();
            $table->string('reason_1')->nullable();
            $table->unsignedInteger('year_2')->nullable();
            $table->unsignedInteger('month_2')->nullable();
            $table->string('name_2', 120)->nullable();
            $table->string('phone_2')->nullable();
            $table->string('position_2')->nullable();
            $table->string('reason_2')->nullable();
            $table->unsignedInteger('year_3')->nullable();
            $table->unsignedInteger('month_3')->nullable();
            $table->string('name_3', 120)->nullable();
            $table->string('phone_3')->nullable();
            $table->string('position_3')->nullable();
            $table->string('reason_3')->nullable();
            $table->unsignedInteger('year_4')->nullable();
            $table->unsignedInteger('month_4')->nullable();
            $table->string('name_4', 120)->nullable();
            $table->string('phone_4')->nullable();
            $table->string('position_4')->nullable();
            $table->string('reason_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
