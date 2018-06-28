<template>
    <div>
        <code-editor ref="sql" :field-name="fieldName" :value="value"></code-editor>
        <a class="btn btn-primary" role="button" @click="beginTest()">Test SQL</a>

        <modals-base v-if="showModal">
            <h3 slot="header" id="myModalLabel">PICS SQL Test</h3>

            <div slot="body">
                <div class="loading">
                    <spinner :loading="loading"></spinner>
                </div>
                <div class="results"></div>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        props: ['fieldName', 'value', 'endpoint'],

        data () {
            return {
                showModal: false,
                loading: true
            }
        },

        methods: {
            beginTest () {
                this.showModal = true

                axios.get(this.endpoint + '?', {
                    params: {
                        q: this.$refs.sql.$refs.textarea.value
                    }
                })
                     .then(function (response) {
                         console.log(response)
//                         if (response.status) {
//                             $('.modal-body .results').html("<h4 class='spacer-bottom-3x'>" + response.data.length + " Results</h4><div class='well-results'></div>");
//                             var $i = 0;
//                             $.each(response.data, function () {
//                                 $('.well-results').append("<pre class='well-result_" + $i + " alert alert-success'></pre>");
//                                 $.each(this, function (key, value) {
//                                     $('.well-result_' + $i).append("<li><strong>" + key + "</strong>: " + $.trim(value) + "</li>");
//                                 });
//                                 $i++;
//                             });
//                         }
//
//                         if (response.errors) {
//                             console.log(response.errors)
//                             console.log(response.errors.status)
//                             $('.modal-body').html("<h4>" + response.errors.status + " Error</h4><p>" + response.errors.title + "</p>");
//                         }
                     })
//                     .catch(function (jqXHR, textStatus, errorThrown) {
//                         console.log(textStatus, errorThrown);
//                         $('.modal-body').html("<h4>Error</h4><p>The server has encountered an error, it could be an error with your SQL.");
//                     })
            }
        }
    }
</script>