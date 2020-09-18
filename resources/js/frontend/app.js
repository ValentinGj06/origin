
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import '../bootstrap';
import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
window.Vue = Vue;

Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// window.axios.defaults.headers.common = {
//     'X-Requested-With': 'XMLHttpRequest',
//     'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
// };

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// Vue.component('clients-table', require('./components/ClientsTableComponent.vue').default);

Vue.component('tags-input', require('@voerro/vue-tagsinput').default);

// Vue.component('vue-categories-management', require('./components/VueCategoriesManagementComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.app = new Vue({
    el: '#app',
    data: {
        inputs: [

        ],
        search_input: '',
        pay_in: '',
        win: '',
        datefilter: '',
        from_city: '',
        isDisabled: true,
        isReadOnly: false,
        clients: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        selectedTags: [],
            name: '',
    },
    methods: {
        setSelectedTags(tags) {
            this.$refs.tags.setSelectedTags(tags);
        },
        setExistingTag(response) {
            this.$refs.tags.setExistingTag(response);
        },
    },
    components: {
       'filter-pay-in': require('./components/FilterPayInComponent.vue').default,
       'filter-win': require('./components/FilterWinComponent.vue').default,
       'filter-reg-date': require('./components/FilterRegDateComponent.vue').default,
       'filter-location': require('./components/FilterLocationComponent.vue').default,
       'vue-tags': require('./components/VueTagsComponent.vue').default,
       'vue-categories-management': require('./components/VueCategoriesManagementComponent.vue').default,
       'vue-tags-management': require('./components/VueTagsManagementComponent.vue').default,
       'doughnut-chart': require('../backend/charts/DoughnutChartContainer.vue').default,
       'line-chart': require('../backend/charts/LineChartContainer.vue').default,
       'bar-chart': require('../backend/charts/BarChartContainer.vue').default,
       'pie-chart': require('../backend/charts/PieChartContainer.vue').default,
       'top-ten': require('./components/VueTopTenComponent.vue').default,
       'top-ten-win': require('./components/VueTopTenWinComponent.vue').default,
       'growth-chart': require('../backend/charts/GrowthLineChartContainer.vue').default,
       'counter-card': require('./components/CounterCardComponent.vue').default,

   }
});
