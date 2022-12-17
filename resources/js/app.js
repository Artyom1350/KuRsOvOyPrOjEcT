import Vue from 'vue';
import MyApplic from './components/MyApplicationComponents.vue';
import IncApplic from './components/IncApplicationComponents.vue';

require('./bootstrap');

const container= new Vue({
    el:'.container',
    components:{
        MyApplic,
        IncApplic
    }
});