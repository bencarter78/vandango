<template>
    <div>
        <input type="hidden" class="form-control" name="place" id="organisation" :value="organisation.place"/>

        <div class="form-group spacer-bottom-3x">
            <label for="organisation_name">Name</label>
            <input id="organisation_name"
                   name="organisation_name"
                   class="form-control"
                   placeholder="Search..."
                   autocomplete="off"
                   v-model="query"
                   @keydown.down="down"
                   @keydown.up="up"
                   @keydown.enter.prevent
                   @keydown.enter="hit"
                   @keydown.esc="reset"
                   @blur="updatePlaceId"
                   @input="search"/>

            <ul class="list-group" v-show="hasItems">
                <li class="list-group-item" v-for="(item, index) in items" :class="activeClass(index)" @mousedown="hit" @mousemove="setActive(index)">
                    <label><i class="fa fa-building-o"></i> {{ item.name.trim() }}</label>
                    <div class="address" v-if="item.addr1">
                        <i class="fa fa-map-marker"></i>
                        <span v-if="item.addr1">{{ item.addr1.trim() }}, </span>
                        <span v-if="item.addr2">{{ item.addr2.trim() }}, </span>
                        <span v-if="item.addr3">{{ item.addr3.trim() }}, </span>
                        <span v-if="item.addr4">{{ item.addr4.trim() }}, </span>
                        <span v-if="item.addr5">{{ item.addr5.trim() }},</span>
                        <span v-if="item.postcode">{{ item.postcode.trim() }}</span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="fixed-address" v-if="organisation.place">
            <div class="form-group spacer-bottom-3x">
                <label>Address</label>
                <div class="postal-address">
                    <i class="fa fa-map-marker"></i>
                    {{ postalAddress() }}
                </div>
            </div>
        </div>

        <div class="new-address" v-else>
            <div class="form-group spacer-bottom-3x">
                <label>Street Address</label>
                <input name="add1" class="form-control" @focus="items = []" placeholder="Address line 1"/>
            </div>

            <div class="form-group spacer-bottom-3x">
                <input name="add2" class="form-control" @focus="items = []" placeholder="Address line 2"/>
            </div>

            <div class="form-group spacer-bottom-3x">
                <input name="add3" class="form-control" @focus="items = []" placeholder="Address line 3"/>
            </div>

            <div class="form-group spacer-bottom-3x">
                <label>Town/City</label>
                <input name="add4" class="form-control" @focus="items = []"/>
            </div>

            <div class="form-group spacer-bottom-3x">
                <label>County</label>
                <input name="add5" class="form-control" @focus="items = []"/>
            </div>

            <div class="form-group spacer-bottom-3x">
                <div class="row">
                    <div class="col-md-4">
                        <label>Post Code</label>
                        <input name="postcode" class="form-control" @focus="items = []"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueTypeahead from 'vue-typeahead'

    export default {
        extends: VueTypeahead,

        props: ['place', 'organisation_name', 'add1', 'add2', 'add3', 'add4', 'add5', 'postcode'],

        data() {
            return {
                query: '',
                organisations: [],
                organisation: {
                    code: '',
                    name: '',
                    add1: '',
                    add2: '',
                    add3: '',
                    add4: '',
                    add5: '',
                    postcode: ''
                },
                src: '/api/v1/papi/organisations',
                limit: 5,
                minChars: 3,
                queryParamName: 'query'
            }
        },

        mounted() {
            this.query = this.organisation_name
        },

        methods: {
            prepareResponseData(data) {
                return data.results
            },

            onHit(item) {
                this.setOrganisation(item)
                this.query = item.name.trim()
                this.items = []
            },

            search(e) {
                if (this.organisation.name != this.query) {
                    this.resetOrganisation()
                    this.update()
                }
            },

            updatePlaceId() {
                this.items = []
                if (this.organisation.name != this.query) {
                    this.resetOrganisation()
                }
            },

            setOrganisation(item) {
                this.organisation = {
                    place: item.place.trim(),
                    name: item.name.trim(),
                    add1: item.addr1 ? item.addr1.trim() : '',
                    add2: item.addr2 ? item.addr2.trim() : '',
                    add3: item.addr3 ? item.addr3.trim() : '',
                    add4: item.addr4 ? item.addr4.trim() : '',
                    add5: item.addr5 ? item.addr5.trim() : '',
                    postcode: item.postcode ? item.postcode.trim() : '',
                }
            },

            resetOrganisation() {
                this.organisation = {}
            },

            postalAddress() {
                let address = [];
                ['add1', 'add2', 'add3', 'add4', 'add5', 'postcode'].forEach(el => {
                    if (this.organisation[el]) {
                        address.push(this.organisation[el].trim())
                    }
                })
                return address.join(', ')
            }
        }
    }
</script>

<style>
    .results li {
        color: #282828;
    }

    li.active {
        color: red;
    }
</style>
