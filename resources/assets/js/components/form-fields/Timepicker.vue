<template>
    <div>
        <ul class="list-inline">
            <li>
                <dropdown field-name="hours" :options="hours()"></dropdown>
            </li>
            <li>
                <dropdown field-name="minutes" :options="minutes()"></dropdown>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        methods: {
            hours () {
                var hours = [{value: '', label: ''}]
                for (let i = 1; i <= 24; i++) {
                    var time = i < 10 ? "0" + i : i
                    hours.push({value: time, label: time})
                }
                return hours;
            },

            minutes () {
                return [
                    {value: "", label: ""},
                    {value: "00", label: "00"},
                    {value: "15", label: "15"},
                    {value: "30", label: "30"},
                    {value: "45", label: "45"},
                ]
            }
        }
    }
</script>