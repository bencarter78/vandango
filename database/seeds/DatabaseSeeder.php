<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') === 'testing') {
            $this->call('GroupsTableSeeder');
            $this->call('DataJobRolesTableSeeder');
        } else {
            $this->call('AuditorTasksTableSeeder');
            $this->call('GroupsTableSeeder');
            $this->call('DataJobRolesTableSeeder');
            $this->call('DataApplicationsTableSeeder');
            $this->call('DataCentresTableSeeder');
            $this->call('DataCoursesTableSeeder');
            $this->call('DataDepartmentsTableSeeder');
            $this->call('DataJobRolesTableSeeder');
            $this->call('DataSectorsTableSeeder');
            $this->call('FailedJobsTableSeeder');
            $this->call('GroupsTableSeeder');
            $this->call('JobsTableSeeder');
            $this->call('JudiAssessmentsTableSeeder');
            $this->call('JudiCancellationsTableSeeder');
            $this->call('JudiCriteriaTableSeeder');
            $this->call('JudiCriteriaReportTableSeeder');
            $this->call('JudiDocumentsTableSeeder');
            $this->call('JudiGradesTableSeeder');
            $this->call('JudiProcessReportTableSeeder');
            $this->call('JudiProcessUserTableSeeder');
            $this->call('JudiProcessesTableSeeder');
            $this->call('JudiReportsTableSeeder');
            $this->call('JudiRoleProcessTableSeeder');
            $this->call('JudiSectorScheduleTableSeeder');
            $this->call('JudiSummariesTableSeeder');
            $this->call('MigrationsTableSeeder');
            $this->call('PasswordResetsTableSeeder');
            $this->call('PortalDeptImportMapTableSeeder');
            $this->call('PortalUserImportsTableSeeder');
            $this->call('SurveyhoundSurveysTableSeeder');
            $this->call('UsersTableSeeder');
            $this->call('UsersDepartmentsTableSeeder');
            $this->call('UsersGroupsTableSeeder');
            $this->call('UsersMetaTableSeeder');
            $this->call('UsersRolesTableSeeder');
            $this->call('UsersSectorsTableSeeder');
        }
    }
}