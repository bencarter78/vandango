// General
Vue.component('autocomplete', require('./components/Autocomplete.vue'))
Vue.component('code-editor', require('./components/CodeEditor.vue'))
Vue.component('modals-base', require('./components/modals/BaseModal.vue'))
Vue.component('vd-paginator', require('./components/Paginator.vue'))
Vue.component('resource-actions', require('./components/ResourceActions.vue'))
Vue.component('vd-flash', require('./components/Flash.vue'))

// Actions
Vue.component('actions-delete', require('./components/actions/Delete.vue'))
Vue.component('actions-link', require('./components/actions/Link.vue'))

// Apply
Vue.component('apply-applicants', require('./components/apply/Applicants.vue'))
Vue.component('apply-applicant-flag', require('./components/apply/FlagApplicant.vue'))
Vue.component('apply-applicant-form', require('./components/apply/ApplicantForm.vue'))
Vue.component('apply-applicant-remove', require('./components/apply/RemoveApplicant.vue'))
Vue.component('apply-assign-adviser', require('./components/apply/AssignAdviser.vue'))
Vue.component('apply-dashboard', require('./components/apply/Dashboard.vue'))
Vue.component('apply-reports-index', require('./components/apply/ReportOverview.vue'))
Vue.component('apply-sector-period-applicants', require('./components/apply/SectorPeriodApplicants.vue'))
Vue.component('apply-unmatched', require('./components/apply/Unmatched.vue'))

// Auditor
Vue.component('task-runner', require('./components/auditor/TaskRunner.vue'))
Vue.component('task-modal', require('./components/auditor/TaskModal.vue'))
Vue.component('test-sql', require('./components/auditor/TestSql.vue'))
Vue.component('auditor-tasks-data-table', require('./components/auditor/TaskDataTable.vue'))

// Ava
Vue.component('ava-application-count', require('./components/ava/ApplicationCount.vue'))
Vue.component('ava-vacancy-applicants-overview', require('./components/ava/VacancyApplicantsOverview.vue'))

// Blink Activities
Vue.component('blink-activity-add', require('./components/blink/activities/Add.vue'))

// Blink Contacts
Vue.component('blink-contact-add', require('./components/blink/contacts/Add.vue'))
Vue.component('blink-contact-data-table', require('./components/blink/contacts/DataTable.vue'))
Vue.component('blink-contact-search', require('./components/blink/contacts/Search.vue'))
Vue.component('blink-update-contact', require('./components/blink/contacts/Update.vue'))

// Blink Courses
Vue.component('blink-courses-data-table', require('./components/blink/courses/DataTable.vue'))
Vue.component('blink-courses-form', require('./components/blink/courses/Form.vue'))

// Blink Departments
Vue.component('blink-department-data-table', require('./components/blink/departments/DataTable.vue'))
Vue.component('blink-department-user-data-table', require('./components/blink/departments/UserDataTable.vue'))

// Blink Enquiries
Vue.component('blink-enquiry-add', require('./components/blink/enquiries/Add.vue'))
Vue.component('blink-enquiry-actions', require('./components/blink/enquiries/Actions.vue'))
Vue.component('blink-enquiry-data-table', require('./components/blink/enquiries/DataTable.vue'))
Vue.component('blink-enquiry-duplicate-check', require('./components/blink/enquiries/DuplicateCheck.vue'))
Vue.component('blink-enquiry-account-manager-update', require('./components/blink/enquiries/UpdateAccountManager.vue'))
Vue.component('blink-enquiry-campaign-update', require('./components/blink/enquiries/UpdateCampaign.vue'))
Vue.component('blink-enquiry-contact-update', require('./components/blink/enquiries/UpdateContact.vue'))
Vue.component('blink-enquiry-employee-count-update', require('./components/blink/enquiries/UpdateEmployeeCount.vue'))
Vue.component('blink-enquiry-location-update', require('./components/blink/enquiries/UpdateLocation.vue'))
Vue.component('blink-enquiry-search', require('./components/blink/enquiries/Search.vue'))

// Blink Opportunities
Vue.component('blink-opportunity-add', require('./components/blink/opportunities/Add.vue'))
Vue.component('blink-opportunity-data-table', require('./components/blink/opportunities/DataTable.vue'))

// Blink Organisations
Vue.component('blink-organisation-actions', require('./components/blink/organisations/Actions.vue'))
Vue.component('blink-organisation-data-table', require('./components/blink/organisations/DataTable.vue'))
Vue.component('blink-organisation-enquiry-data-table', require('./components/blink/organisations/EnquiryDataTable.vue'))
Vue.component('blink-organisation-pics-sync', require('./components/blink/organisations/PicsSync.vue'))
Vue.component('blink-organisation-search', require('./components/blink/organisations/Search.vue'))
Vue.component('blink-organisation-update', require('./components/blink/organisations/Update.vue'))

// Blink Vacancies
Vue.component('blink-vacancy-closing-date-update', require('./components/blink/vacancies/UpdateClosingDate.vue'))
Vue.component('blink-vacancy-hires-add', require('./components/blink/vacancies/AddHire.vue'))
Vue.component('blink-vacancy-ref-update', require('./components/blink/vacancies/UpdateRef.vue'))
Vue.component('blink-vacancy-application-manager-update', require('./components/blink/vacancies/UpdateApplicationManager.vue'))
Vue.component('blink-vacancy-approval', require('./components/blink/vacancies/Approval.vue'))
Vue.component('blink-vacancy-data-table', require('./components/blink/vacancies/DataTable.vue'))
Vue.component('blink-vacancy-remove', require('./components/blink/vacancies/Removal.vue'))

// Buttons
Vue.component('buttons-submit', require('./components/buttons/Submit.vue'))
Vue.component('buttons-default', require('./components/buttons/Default.vue'))

// Charts
Vue.component('chart-bar', require('./components/charts/BarChart.vue'))
Vue.component('chart-pie', require('./components/charts/PieChart.vue'))

// Classroom
Vue.component('course-register', require('./components/classroom/CourseRegister.vue'))
Vue.component('timetable-data-table', require('./components/classroom/TimetableDataTable.vue'))

// CPD
Vue.component('cpd-activity', require('./components/cpd/Activity.vue'))
Vue.component('cpd-activity-data-table', require('./components/cpd/ActivityDataTable.vue'))
Vue.component('cpd-certificates-upload', require('./components/cpd/CertificateUpload.vue'))
Vue.component('cpd-cv-upload', require('./components/cpd/CvUpload.vue'))
Vue.component('cpd-user-dashboard', require('./components/cpd/UserDashboard.vue'))

// Errors
Vue.component('errors-default', require('./components/errors/Default.vue'))

// Forms
Vue.component('checkbox-toggle', require('./components/form-fields/CheckboxToggle.vue'))
Vue.component('datepicker', require('./components/form-fields/Datepicker.vue'))
Vue.component('dropdown', require('./components/form-fields/Dropdown.vue'))
Vue.component('forms-error', require('./components/forms/ErrorMessage.vue'))
Vue.component('text-editor', require('./components/form-fields/TextEditor.vue'))
Vue.component('text-field', require('./components/form-fields/TextField.vue'))
Vue.component('text-field-addon-left', require('./components/form-fields/TextFieldAddOnLeft.vue'))
Vue.component('text-area', require('./components/form-fields/TextArea.vue'))
Vue.component('timepicker', require('./components/form-fields/Timepicker.vue'))

// Form Fields
Vue.component('form-datepicker', require('./components/forms/fields/Datepicker.vue'))
Vue.component('form-dropdown', require('./components/forms/fields/Dropdown.vue'))
Vue.component('form-file-upload', require('./components/forms/fields/FileUpload.vue'))
Vue.component('form-text-field', require('./components/forms/fields/TextField.vue'))
Vue.component('form-text-area', require('./components/forms/fields/TextArea.vue'))
Vue.component('form-text-editor', require('./components/forms/fields/TextEditor'))
Vue.component('form-label', require('./components/forms/Label.vue'))

// Forum
Vue.component('forum-channel-add', require('./components/forum/ChannelAdd'))
Vue.component('forum-replies', require('./components/forum/Replies'))
Vue.component('forum-reply', require('./components/forum/Reply'))
Vue.component('forum-reply-add', require('./components/forum/ReplyAdd'))
Vue.component('forum-subscriber', require('./components/forum/Subscriber'))
Vue.component('forum-thread', require('./components/forum/Thread'))
Vue.component('forum-thread-add', require('./components/forum/ThreadAdd'))
Vue.component('forum-thread-heading', require('./components/forum/ThreadHeading'))

// Ignite
Vue.component('ignite-campaigns-report', require('./components/ignite/CampaignReport.vue'))

// Judi
Vue.component('judi-sector-search', require('./components/judi/SectorSearch.vue'))
Vue.component('judi-criteria-sort', require('./components/judi/CriteriaSort.vue'))

// KeySafe
Vue.component('keyList', require('./components/keysafe/KeyList.vue'))

// Loaders (Spinners)
Vue.component('spinner', require('./components/loaders/Spinner.vue'))
Vue.component('loaders-pulse', require('./components/loaders/Pulse.vue'))
Vue.component('loaders-clip', require('./components/loaders/Clip.vue'))

// Locations
Vue.component('address-create', require('./components/locations/AddressCreate.vue'))
Vue.component('address-remove', require('./components/locations/AddressRemove.vue'))
Vue.component('address-update', require('./components/locations/AddressUpdate.vue'))
Vue.component('venue-search', require('./components/locations/VenueSearch.vue'))

// Pics
Vue.component('search-organisations', require('./components/pics/SearchOrganisations.vue'))
Vue.component('qual-plans-select', require('./components/pics/QualPlansSelect.vue'))

// RoomMate
Vue.component('rooms-data-table', require('./components/roommate/RoomsDataTable.vue'))

// UserManager
Vue.component('user-full-name', require('./components/usermanager/UserFullName.vue'))
Vue.component('user-contact-details', require('./components/usermanager/UserContactDetails.vue'))
Vue.component('department-search', require('./components/usermanager/DepartmentSearch.vue'))
Vue.component('probation-users', require('./components/usermanager/ProbationUsers.vue'))
Vue.component('search-users', require('./components/usermanager/SearchUsers.vue'))
Vue.component('sector-search', require('./components/usermanager/SectorSearch.vue'))
Vue.component('user-notifications', require('./components/usermanager/Notifications.vue'))
Vue.component('user-search', require('./components/usermanager/UserSearch.vue'))
