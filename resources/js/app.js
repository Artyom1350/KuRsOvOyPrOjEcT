import Vue from 'vue';
import MyApplic from './components/outputApplic/MyApplicationComponents.vue';
import IncApplic from './components/outputApplic/IncApplicationComponents.vue';
import DoApplic from './components/ViewApplic/DoApplicationComponents.vue';
import ModalWindow from './components/modalWindows/ModalWindowPeople.vue';
import ViewAppl from './components/ViewApplic/ViewApplicationComponents.vue';
import ChangeAppl from './components/ViewApplic/ChangeApplicationComponents.vue';
import ModalWindowAnsw from './components/modalWindows/ModalWindowAnswer.vue';
import GroupViewAdmin from './components/adminComponent/GroupViewComponents.vue';
import UserViewAdmin from './components/adminComponent/UserViewComponents.vue';

require('./bootstrap');
Vue.config.devtools=false;
const container= new Vue({
    el:'.container',
    components:{
        MyApplic,
        IncApplic,
        DoApplic,
        ModalWindow,
        ViewAppl,
        ChangeAppl,
        ModalWindowAnsw,
        GroupViewAdmin,
        UserViewAdmin
    }
});