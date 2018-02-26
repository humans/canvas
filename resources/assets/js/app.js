import Vue from 'vue'
import axios from 'axios'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

/**
 * If needed, Canvas ships with redux with a pretty good starting point for
 * the architecture.
 *
 * To install:
 *      yarn add vuex
 *
 * Import the store and add it to the root Vue instance.
 */

// import store from './vuex/store'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',

    data: { user: {} },

    mounted() {
        this.refreshUser()
    },

    methods: {

        /**
         * This is an example method to test and demonstrate that Laravel Passport
         * is working right out of the box.
         */
        refreshUser() {
            axios.get('/api/user').then(({ data: user }) => this.user = user)
        },

    },
})
