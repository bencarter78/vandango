<template>
    <nav aria-label="Page navigation">
        <ul v-if="shouldPaginate" class="pagination">
            <li :class="{disabled: prevUrl == null}">
                <a href="#" aria-label="Previous" rel="prev" @click.prevent="pageDown">
                    <span aria-hidden="true">
                        <i class="fa fa-chevron-left"></i>
                    </span>
                </a>
            </li>

            <li :class="{disabled: nextUrl == null}">
                <a href="#" aria-label="Next" @click.prevent="pageUp">
                    <span aria-hidden="true">
                        <i class="fa fa-chevron-right"></i>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: this.dataSet.current_page,
                prevUrl: this.dataSet.prev_page_url,
                nextUrl: this.dataSet.next_page_url
            }
        },

        watch: {
            page() {
                this.broadcast().updateUrl()
            }
        },

        computed: {
            shouldPaginate() {
                return !!this.prevUrl || !!this.nextUrl
            }
        },

        methods: {
            pageDown() {
                if (this.prevUrl)
                    this.page--
            },

            pageUp() {
                if (this.nextUrl)
                    this.page++
            },

            broadcast() {
                return this.$emit('changed', this.page)
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page)
            }
        }
    }
</script>
