<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div :class="'modal-container ' + containerClasses">
                    <div class="modal-header">
                        <div class="pull-right">
                            <button type="button" class="close" @click="close">×</button>
                        </div>
                        <div class="text-left">
                            <slot name="header"></slot>
                        </div>
                    </div>

                    <div class="modal-body">
                        <slot name="body"></slot>
                    </div>

                    <div class="modal-footer text-left">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            containerClasses: {default: ''}
        },

        methods: {
            close() {
                this.$parent.showModal = false
                this.$emit('modal-close')
            }
        }
    }
</script>