window._ = require('lodash')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery')

    require('bootstrap-sass')
} catch (e) {
}

var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content')

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue')

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios')
Vue.prototype.$http = window.axios

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Pusher from "pusher-js"
import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6835853718fc575a60e7',
    cluster: 'eu',
    encrypted: true
})

/**
 * Polyfills
 */
if (typeof Object.assign != 'function') {
    Object.assign = function (target) {
        'use strict'
        if (target == null) {
            throw new TypeError('Cannot convert undefined or null to object')
        }

        target = Object(target)
        for (var index = 1; index < arguments.length; index++) {
            var source = arguments[index]
            if (source != null) {
                for (var key in source) {
                    if (Object.prototype.hasOwnProperty.call(source, key)) {
                        target[key] = source[key]
                    }
                }
            }
        }
        return target
    }
}

window.events = new Vue()
window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level})
}
