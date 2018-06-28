<script>
    export default {
        data() {
            return {
                progTypes: [
                    {label: 'Please select...', value: ''},
                    {label: 'Study Programme', value: 'Study Programme'},
                    {label: 'Traineeship', value: 'Traineeship'},
                    {label: 'Standard', value: 'Standard'},
                    {label: 'Framework', value: 'Framework'},
                    {label: 'ESF', value: 'ESF'},
                    {label: 'Advanced Learner Loan', value: 'Advanced Learner Loan'},
                    {label: 'Adult Education Budget (Classroom/WBL)', value: 'Adult Education Budget (Classroom/WBL)'},
                    {label: 'Commercial', value: 'Commercial'}
                ]
            }
        },

        methods: {
            getStartsCount(applicants) {
                if (applicants.length) {
                    let count = applicants.filter(app => app.started_on != null).length
                    if (count > 0) {
                        return count
                    }
                }
                return ''
            }
        }
    }
</script>