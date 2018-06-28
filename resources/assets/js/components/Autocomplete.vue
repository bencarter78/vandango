<template>
    <div>
        <input :name="fieldName" type="hidden" v-bind:value="values.id">

        <input :name="'search[' + fieldName + ']'"
               type="text"
               class="form-control"
               placeholder="Search..."
               autocomplete="off"
               v-model="query"
               @keydown.down="down"
               @keydown.up="up"
               @keydown.enter.prevent
               @keydown.enter="hit"
               @keydown.esc="reset"
               @blur="isValid"
               @input="search"/>

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
    /**
     * This is now being deprecated. You should now use Typeahead
     * @deprecated
     */

    import VueTypeahead from 'vue-typeahead'

    export default {
        extends: VueTypeahead,

        props: [
            'endpoint', // The url to query
            'fieldName', // Than name of the input
            'values', // The original values of the search input and the hidden input
            'format' // A function to format the results
        ],

        data() {
            return {
                query: '',
                src: this.endpoint,
                limit: 10,
                minChars: 3,
                queryParamName: 'q'
            }
        },

        mounted() {
//            this.checkRequiredProps()
            this.query = this.values.search
        },

        watch: {
            values() {
                this.query = this.values.search
            }
        },

        methods: {
            checkRequiredProps() {
                for (let prop in this.$props) {
                    if (this[prop] == null) {
                        throw new Error(prop + ' is null. Please define a value for this prop.')
                    }
                }
            },

            prepareResponseData(items) {
                return this.format(items)
            },

            search() {
                if (this.values.search !== this.query) {
                    this.update()
                    this.isValid()
                }
            },

            onHit(item) {
                this.$emit('itemSelected', item)
                this.query = this.values.search = item.display
                this.values.id = item.id
                this.items = []
            },

            isValid() {
                if (this.values.search != this.query) {
                    this.values.id = ''
                }
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
