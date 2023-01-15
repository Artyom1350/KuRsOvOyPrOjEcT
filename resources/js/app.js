import Vue from 'vue';
import MyApplic from './components/outputApplic/MyApplicationComponents.vue';
import IncApplic from './components/outputApplic/IncApplicationComponents.vue';
import DoApplic from './components/ViewApplic/DoApplicationComponents.vue';
import ModalWindow from './components/ModalWindowPeople.vue';
import ViewAppl from './components/ViewApplic/ViewApplicationComponents.vue';
import ChangeAppl from './components/ViewApplic/ChangeApplicationComponents.vue';

require('./bootstrap');

const container= new Vue({
    el:'.container',
    components:{
        MyApplic,
        IncApplic,
        DoApplic,
        ModalWindow,
        ViewAppl,
        ChangeAppl,
    }
});