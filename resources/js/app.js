import Vue from 'vue';
import MyApplic from './components/MyApplicationComponents.vue';
import IncApplic from './components/IncApplicationComponents.vue';
import DoApplic from './components/DoApplicationComponents.vue';
import ModalWindow from './components/ModalWindowPeople.vue'

require('./bootstrap');

const container= new Vue({
    el:'.container',
    components:{
        MyApplic,
        IncApplic,
        DoApplic,
        ModalWindow
    }
});