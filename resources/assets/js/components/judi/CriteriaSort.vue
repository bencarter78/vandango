<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="list-group draggable">
                    <div class="list-group-item active">Selected</div>
                    <draggable v-model="selected" :options="{group: 'criteria'}" @start="drag=true" @end="drag=false" style="min-height: 50px">
                        <div class="list-group-item" v-for="item in selected">
                            <i class="fa fa-navicon spacer-right"></i>
                            {{item.name}}
                            <input type="hidden" v-bind:value="item.id" name="criteria[]">
                        </div>
                    </draggable>
                </div>
            </div>

            <div class="col-md-6">
                <div class="list-group draggable">
                    <div class="list-group-item active">Available</div>
                    <draggable v-model="available" :options="{group: 'criteria'}" @start="drag=true" @end="drag=false">
                        <div class="list-group-item" v-for="item in available">
                            <i class="fa fa-navicon spacer-right"></i>
                            {{item.name}}
                        </div>
                    </draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import Helpers from '../../libs/Helpers'

    export default {
        components: {draggable},

        props: ['criteria', 'report'],

        data () {
            return {
                available: [],
                selected: [],
                test: ["Foor", "Bar", "FooBar"]
            }
        },

        mounted () {
            var selected = JSON.parse(this.report)
            console.log(selected)
            if (selected.criteria) {
                for (let i = 0; i < selected.criteria.length; i++) {
                    this.selected.push(selected.criteria[i])
                }
            }

            var available = JSON.parse(this.criteria)
            for (let i = 0; i < available.length; i++) {
                if (!Helpers.contains(available[i].id, this.selected)) {
                    this.available.push(available[i])
                }
            }
        }
    }
</script>

<style>
    .draggable {
        max-height: 500px;
        overflow: auto;
    }

    .draggable .list-group-item {
        cursor: move;
    }
</style>