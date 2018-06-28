<template>
    <div>
        <div class="alert alert-danger" v-if="hasError">
            <i class="fa fa-warning"></i> {{ error }}
        </div>

        <form method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="guest_first_name">First Name</label>
                        <input name="first_name" v-model="first_name" type="text" class="form-control"/>
                        <div class="spacer-top-1x alert alert-danger" v-if="errors.first_name">
                            <i class="fa fa-warning"></i> {{ errors.first_name }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="guest_surname">Surname</label>
                        <input name="surname" v-model="surname" type="text" class="form-control"/>
                        <div class="spacer-top-1x alert alert-danger" v-if="errors.surname">
                            <i class="fa fa-warning"></i> {{ errors.surname }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" v-model="email" type="text" class="form-control"/>
                        <div class="spacer-top-1x alert alert-danger" v-if="errors.email">
                            <i class="fa fa-warning"></i> {{ errors.email }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input name="company" v-model="company" type="text" class="form-control"/>
                    </div>
                </div>
            </div>

            <button class="btn btn-secondary" id="submit" type="submit" v-on:click="submit">Add</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['hasAccess', 'timetable', 'currentUserId'],

        data () {
            return {
                email: '',
                first_name: '',
                surname: '',
                company: '',
                hasError: false,
                error: '',
                errors: {
                    email: '',
                    first_name: '',
                    surname: ''
                }
            }
        },

        methods: {
            submit (e) {
                e.preventDefault()
                this.resetErrors()
                this.getGuest()
            },

            resetErrors () {
                this.errors.email = ''
                this.errors.first_name = ''
                this.errors.surname = ''
            },

            getGuest () {
                var self = this

                axios.post('/api/v1/usermanager/guests/', {
                    email: self.email,
                    first_name: self.first_name,
                    surname: self.surname,
                    company: self.company
                })
                     .then(function (response) {
                         self.addToCohort(response.data)
                         self.resetForm()
                     })
                     .catch(function (errors) {
                         self.setErrors(errors.data)
                     })
            },

            resetForm () {
                this.email = ''
                this.first_name = ''
                this.surname = ''
                this.company = ''
            },

            addToCohort (user) {
                var self = this

                axios.post('/api/v1/classroom/timetable/' + self.timetable.id + '/cohort', {
                    guest_id: user.id,
                    auth_user_id: self.currentUserId
                })
                     .then(function (response) {
                         if (response.data.errors) {
                             self.hasError = true
                             self.error = response.data.errors.detail
                         } else {
                             self.hasError = false
                             self.$emit('user-was-added', user)
                         }
                     })
                     .catch(function (err) {
                         console.log(err)
                     })
            },

            setErrors (errors) {
                this.errors.email = errors.email ? errors.email[0] : ''
                this.errors.first_name = errors.first_name ? errors.first_name[0] : ''
                this.errors.surname = errors.surname ? errors.surname[0] : ''
            }
        }
    }
</script>