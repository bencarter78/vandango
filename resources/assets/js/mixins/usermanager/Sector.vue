<script>
    export default {
        data() {
            return {
                sectors: []
            }
        },

        methods: {
            fetchSectors(orderBy = null) {
                this.$http
                    .get(route('api.usermanager.sectors.index'))
                    .then((res) => {
                        this.sectors = res.data
                        if (orderBy) {
                            this.sortSectors(orderBy)
                        }
                    })
                    .catch(err => console.log(err))
            },

            sortSectors(orderBy) {
                this.sectors.sort((a, b) => a[orderBy] < b[orderBy] ? -1 : a[orderBy] > b[orderBy] ? 1 : 0)
            },

            userInSectorHierarchy(sectorId, userId) {
                let sector = this.sectors.filter(s => s.id == sectorId)
                if (sector.length) {
                    return sector[0].department.manager_id == userId || sector[0].ad_id == userId
                }
            }
        }
    }
</script>
