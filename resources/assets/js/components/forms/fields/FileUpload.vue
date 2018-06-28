<template>
    <div>
        <div class="flex items-center dropzone justify-center font-size-larger text-blue border-2 border-blue border-dashed h-64"></div>
    </div>
</template>

<script>
    import Dropzone from 'dropzone'

    export default {
        props: {
            label: String,
            options: {
                type: Object
            }
        },

        data() {
            return {
                defaultOptions: {
                    dictDefaultMessage: 'Drop files here or click to upload'
                }
            }
        },

        mounted() {
            new Dropzone('.dropzone', Object.assign(this.defaultOptions, this.options))
                .on('success', (file, res) => this.$emit('success', {file: file, response: res}))
        }
    }
</script>

<style lang="scss">
    @import './../../../../sass/vandango/variables';
    @import '~dropzone/dist/dropzone.css';

    .dropzone {
        border: 2px dashed $grayLight;
    }
</style>