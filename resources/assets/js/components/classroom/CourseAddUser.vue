<template>
    <div>
        <div class="alert alert-danger" v-if="hasError">
            <i class="fa fa-warning"></i> {{ error }}
        </div>

        <input id="user"
               name="user"
               type="text"
               class="form-control"
               placeholder="Search..."
               autocomplete="off"
               v-model="query"
               @keydown.down="down"
               @keydown.up="up"
               @keydown.enter.prevent
               @keydown.enter="hit"
               @click="select()"
               @keydown.esc="reset"
               @input="update"/>

        <div style="position: absolute; z-index:999;">
            <ul class="list-group" v-show="hasItems">
                <li class="list-group-item" v-for="(item, index) in items" :class="activeClass(index)" @mousedown="hit" @mousemove="setActive(index)">
                    <i class="fa fa-user fa-fw"></i> {{ item.first_name }} {{ item.surname }}

                    <ul class="list-inline">
                        <li v-for="department in item.departments">
                            <small>{{ department.department }}</small>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import VueTypeahead from 'vue-typeahead'

    export default {
        extends: VueTypeahead,

        props: ['hasAccess', 'timetable', 'currentUserId'],

        data() {
            return {
                query: '',
                src: '/api/v1/usermanager/users/search',
                limit: 5,
                minChars: 3,
                queryParamName: 'q',
                hasError: false,
                error: ''
            }
        },

        methods: {
            select () {
                if (this.items.length > 0) {
                    this.$parent.hit()
                }
            },

            onHit (item) {
                this.hasError = false
                this.query = ''
                this.items = []
                this.addToCohort(item)
            },

            addToCohort (user) {
                var self = this

                axios.post('/api/v1/classroom/timetable/' + self.timetable.id + '/cohort', {
                    user_id: user.id,
                    auth_user_id: self.currentUserId
                })
                     .then(function (response) {
                         if (response.data.errors) {
                             self.hasError = true
                             self.error = response.data.errors.detail
                         } else {
                             self.$emit('user-was-added', user)
                         }
                     })
                     .catch(function (err) {
                         console.log(err)
                     })
            }
        }
    }
</script>
