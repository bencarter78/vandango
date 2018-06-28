<script>
    var Pusher = require('pusher-js');

    export default {
        data() {
            return {
                pusher: null
            }
        },
        created() {
            this.pusher = new Pusher('0b931ecf26d8c723251d', {
                cluster: 'eu',
                encrypted: true
            });

            this.subscribeToChannel();
        },
        methods: {
            subscribeToChannel() {
                var self = this;
                var channel = this.pusher.subscribe('general');
                channel.bind('App\\Events\\MessageWasBroadcast', function (data) {
                    self.newMessage(data);
                });
            },
            newMessage(data) {
                // SweetAlert
                swal({title: "Notification", text: data.message, type: data.alert, confirmButtonText: "Ok"});
            }
        }
    };
</script>
