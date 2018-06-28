<template>
    <div>
        <input class="form-control"
               placeholder="Search..."
               autocomplete="off"
               v-model="query"
               @keydown.down="down"
               @keydown.up="up"
               @keydown.enter.prevent
               @keydown.enter="hit"
               @keydown.esc="reset"
               @blur="resetItems"
               @input="update"/>

        <div id="autocomplete-results" v-if="hasItems">
            <ul class="list-group results">
                <li class="list-group-item results-item"
                    v-for="(item, index) in items"
                    :class="activeClass(index)"
                    @mousedown="hit"
                    @mousemove="setActive(index)">
                    {{ item.resultsDisplay }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import VueTypeahead from 'vue-typeahead'

    export default {
        extends: VueTypeahead,

        props: {
            endpoint: String,
            fieldName: String,
            value: String,
            format: Function
        },

        data() {
            return {
                query: '',
                src: this.endpoint,
                limit: 10,
                minChars: 3,
                queryParamName: 'q',
            }
        },

        mounted() {
            this.query = this.value
        },

        watch: {
            value() {
                this.query = this.value
            }
        },

        methods: {
            prepareResponseData(items) {
                return this.format(items)
            },

            onHit(item) {
                this.query = item.display
                this.resetItems()
            },

            resetItems() {
                this.$emit('input', this.query)
                this.items = []
            }
        }
    }
</script>

<style>
    #autocomplete-results {
        position: absolute;
        z-index: 999;
    }
</style>
