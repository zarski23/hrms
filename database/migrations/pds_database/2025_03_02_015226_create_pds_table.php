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
        Schema::connection('third_db')->create('applicants', function (Blueprint $table) {
            $table->id('applicant_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('name_extension')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('civil_status');
            $table->string('citizenship');
            $table->decimal('height_cm', 5, 2);
            $table->decimal('weight_kg', 5, 2);
            $table->string('blood_type');
            $table->string('mobile_no');
            $table->string('telephone_no')->nullable();
            $table->string('email_address');
            $table->string('gsis_no')->nullable();
            $table->string('pagibig_no')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('sss_no')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('agency_employee_no')->nullable();
            $table->timestamps();
        });
        
        Schema::connection('third_db')->create('addresses', function (Blueprint $table) {
            $table->id('address_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('house_no');
            $table->string('street');
            $table->string('subdivision')->nullable();
            $table->string('barangay');
            $table->string('city');
            $table->string('province');
            $table->string('zip_code');
            $table->enum('type', ['Residential', 'Permanent']);
            $table->timestamps();
        });
        
        Schema::connection('third_db')->create('family', function (Blueprint $table) {
            $table->id('family_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('relation');
            $table->string('full_name');
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->string('business_address')->nullable();
            $table->string('telephone_no')->nullable();
            $table->timestamps();
        });

        Schema::connection('third_db')->create('children', function (Blueprint $table) {
            $table->id('child_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('child_name');
            $table->date('child_birthdate');
            $table->timestamps();
        });

        Schema::connection('third_db')->create('education', function (Blueprint $table) {
            $table->id('education_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('level'); // 'Elementary', 'Secondary', 'Vocational', 'College', 'Graduate'
            $table->string('school_name');
            $table->string('course')->nullable(); // Only for Vocational, College, and Graduate
            $table->integer('year_graduated')->nullable();
            $table->string('units_earned')->nullable(); // Only for Vocational, College, Graduate
            $table->string('dates_attended');
            $table->string('academic_honors')->nullable();
            $table->timestamps();
        });

        Schema::connection('third_db')->create('civil_service_eligibility', function (Blueprint $table) {
            $table->id('eligibility_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('eligibility_type');
            $table->decimal('rating', 5, 2);
            $table->date('exam_date');
            $table->string('exam_place');
            $table->string('license_number');
            $table->date('validity_date')->nullable();
            $table->timestamps();
        });

        Schema::connection('third_db')->create('work_experience', function (Blueprint $table) {
            $table->id('work_id');
            $table->unsignedBigInteger('applicant_id');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->string('position');
            $table->string('agency');
            $table->decimal('salary', 10, 2);
            $table->string('salary_grade');
            $table->string('status');
            $table->boolean('government_service')->default(false);
            $table->timestamps();
        });

        Schema::connection('third_db')->create('volunteer_work', function (Blueprint $table) {
            $table->id('volunteer_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('organization_name');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->integer('hours_volunteered');
            $table->string('position');
            $table->timestamps();
        });
        
        Schema::connection('third_db')->create('training_programs', function (Blueprint $table) {
            $table->id('training_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('title');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->integer('hours');
            $table->string('type');
            $table->string('sponsor');
            $table->timestamps();
        });

        Schema::connection('third_db')->create('skills_distinctions_memberships', function (Blueprint $table) {
            $table->id('record_id');
            $table->unsignedBigInteger('applicant_id');
            $table->text('skills_hobbies')->nullable();
            $table->text('distinctions')->nullable();
            $table->text('memberships')->nullable();
            $table->timestamps();
        });

        Schema::connection('third_db')->create('additional_questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->unsignedBigInteger('applicant_id');
            $table->integer('question_number'); // Store question number (1,2,3)
            $table->string('answer'); // Store the answer to the question
            $table->timestamps();
        });

        Schema::connection('third_db')->create('references', function (Blueprint $table) {
            $table->id('reference_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('reference_name');
            $table->string('reference_address');
            $table->string('contact_no');
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('pds');
        Schema::connection('third_db')->dropIfExists('children');
        Schema::connection('third_db')->dropIfExists('family');
        Schema::connection('third_db')->dropIfExists('addresses');
        Schema::connection('third_db')->dropIfExists('applicants');
        Schema::connection('third_db')->dropIfExists('education');
        Schema::connection('third_db')->dropIfExists('civil_service_eligibility');
        Schema::connection('third_db')->dropIfExists('work_experience');
        Schema::connection('third_db')->dropIfExists('volunteer_work');
        Schema::connection('third_db')->dropIfExists('training_programs');
        Schema::connection('third_db')->dropIfExists('skills_distinctions_memberships');
        Schema::connection('third_db')->dropIfExists('additional_questions');
        Schema::connection('third_db')->dropIfExists('references');
        Schema::connection('third_db')->dropIfExists('pdf_files');
    }
};
