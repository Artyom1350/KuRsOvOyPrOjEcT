<template>
    <div>
        <div class="form-group mt-2">
            <input type="text" class="form-control searchString" placeholder="Поиск заявок" name="search" @keyup="getsearch"
            v-model="textSearch">
        </div>
        <div  class="wrap-card " v-for="(applicat,index) in mydata">
            <div class="h-auto p-1 application d-flex justify-content-between" :id="'appl'+index" :key="index">
                <h3 class="w-50">{{applicat.name}}</h3>
                <a class="w-12" :href="'/myAppl/Download/'+applicat.id"><button class=" btn btn-primary">Скачать документ</button></a>
                <a class="w-12" :href="'/myAppl/changeApplication/'+applicat.id"><button class=" btn btn-primary">Редактировать заявку</button></a>
                <a class="w-12" :href="'#appl'+ index "><button @click="openModalWind(applicat.id)" class=" btn btn-primary">Посмотреть статусы пользователей</button></a>
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
                idDocumentOpen:0,
                textSearch:''
            };
        },methods:{
            openModalWind(idDocument){
                this.idDocumentOpen=idDocument;
                this.trigerModal=true;
            },
            getsearch(){
                for( var i=0;i< $('.wrap-card').length;i++){
                    var el=$('.wrap-card')[i];
                    
                    if(el.outerText.includes(this.textSearch)){
                        el.style.display="block"
                    }else{
                        el.style.display="none"
                        
                    }
                }
            }
        },
        components:{
            ModalWindowAnsw
        },
    }
</script>

<style>
w-12{
    width: 12% !important;
}
</style>