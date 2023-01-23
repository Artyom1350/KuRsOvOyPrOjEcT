<template>
    <div>
        <div  class="wrap-card" v-for="(applicat,index) in mydata">
            <div class="application d-flex justify-content-between" :id="'appl'+index" :key="index">
                <h3>{{applicat.name}}</h3>
                <a :href="'/myAppl/Download/'+applicat.id"><button class="btn btn-primary">Скачать документ</button></a>
                <a :href="'/myAppl/changeApplication/'+applicat.id"><button class="btn btn-primary">Редактировать заявку</button></a>
                <a :href="'#appl'+ index "><button @click="openModalWind(applicat.id)" class="btn btn-primary">Посмотреть статусы пользователей</button></a>
            </div>
        </div>
        <ModalWindowAnsw v-if="trigerModal" @close="trigerModal=false" :idDocuments="idDocumentOpen"></ModalWindowAnsw>
        
    </div>
</template>

<script>
    import ModalWindowAnsw from '../modalWindows/ModalWindowAnswer.vue';

    export default {
        props: ['mydata'],
        data(){
            return{
                trigerModal:false,
                idDocumentOpen:0
            };
        },methods:{
            openModalWind(idDocument){
                this.idDocumentOpen=idDocument;
                this.trigerModal=true;
            }
        },
        components:{
            ModalWindowAnsw
        },
    }
</script>
