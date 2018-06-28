require('./bootstrap')
require('./components')
require('es6-promise').polyfill();

new Vue({
    el: '#app',
})