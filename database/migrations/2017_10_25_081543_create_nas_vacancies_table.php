<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNasVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nas_vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string("VacancyReference")->index();
            $table->text("ApprenticeshipFramework")->nullable();
            $table->dateTime("ClosingDate")->nullable();
            $table->dateTime("CreatedDateTime")->nullable();
            $table->text("EmployerName")->nullable();
            $table->text("LearningProviderName")->nullable();
            $table->text("NumberOfPositions")->nullable();
            $table->text("ShortDescription")->nullable();
            $table->text("VacancyAddress")->nullable();
            $table->text("VacancyLocationType")->nullable();
            $table->text("VacancyTitle")->nullable();
            $table->text("VacancyType")->nullable();
            $table->text("VacancyUrl")->nullable();
            $table->text("ContactPerson")->nullable();
            $table->text("ContractOwner")->nullable();
            $table->text("DeliveryOrganisation")->nullable();
            $table->text("EmployerDescription")->nullable();
            $table->text("EmployerWebsite")->nullable();
            $table->text("ExpectedDuration")->nullable();
            $table->text("FullDescription")->nullable();
            $table->text("FutureProspects")->nullable();
            $table->dateTime("InterviewFromDate")->nullable();
            $table->boolean("IsDisplayRecruitmentAgency")->nullable();
            $table->boolean("IsSmallEmployerWageIncentive")->nullable();
            $table->text("LearningProviderDesc")->nullable();
            $table->text("LearningProviderSectorPassRate")->nullable();
            $table->text("OtherImportantInformation")->nullable();
            $table->text("PersonalQualities")->nullable();
            $table->dateTime("PossibleStartDate")->nullable();
            $table->text("QualificationRequired")->nullable();
            $table->text("SkillsRequired")->nullable();
            $table->text("SupplementaryQuestion1")->nullable();
            $table->text("SupplementaryQuestion2")->nullable();
            $table->text("TrainingToBeProvided")->nullable();
            $table->text("VacancyManager")->nullable();
            $table->text("VacancyOwner")->nullable();
            $table->text("Wage")->nullable();
            $table->text("WageText")->nullable();
            $table->text("WageType")->nullable();
            $table->text("WorkingWeek")->nullable();
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
        Schema::drop('nas_vacancies');
    }
}
