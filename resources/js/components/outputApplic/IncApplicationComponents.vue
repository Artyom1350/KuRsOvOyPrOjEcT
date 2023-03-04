<template>
    <div>
        <div class="form-group mt-2">
            <input type="text" class="form-control searchString" placeholder="Поиск отделений" name="search" @keyup="getsearch"
            v-model="textSearch">
        </div>
        <div v-for="(applicat, index) in arrayAppl" :key="applicat.id">
            <div class="wrap-card" :class="(index<countPagination)?'':'d-noneInput'">
                <div class="application p-1 h-auto d-flex justify-content-between">
                    <p class="ml-3 mr-3" ><b>{{applicat.userName}}</b></p>
                    <p>{{applicat.title}}</p>
                    <a class="mr-3" :href="'incAppl/'+applicat.idDocument"><button class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                    </button></a>
                </div>
            </div>
        </div>
        <div class="makeAppl d-block ml-auto mt-3">
            <input v-if="!trigerPagin && trigerGlobalPagin" class="btn btn-primary d-block ml-auto mt-3" type="button" value="Показать ещё" @click="pagination">
            <input v-if="trigerPagin && trigerGlobalPagin" class="btn btn-primary d-block ml-auto mt-3" type="button" value="Скрыть всё" @click="notPagination">
        </div>
    </div>
    
</template>

<script>
    export default {
        mounted() {
        },
        props: ['incdata'],
        data(){
            return{
                arrayAppl: this.$props.incdata,
                textSearch:'',
                countPagination: 3,
                trigerPagin:false,
                trigerGlobalPagin:false
            }
        },
        methods:{
            getsearch(){
                if( this.textSearch.length == 0){
                    this.countPagination=3;
                }
                else this.countPagination=999999999999999;
                for( var i=0;i< $('.wrap-card').length;i++){
                    var el=$('.wrap-card')[i];
                    
                    if(el.outerText.includes(this.textSearch)){
                        el.style.display="block"
                    }else{
                        el.style.display="none"
                        
                    }
                }
            },
            pagination(){
                this.countPagination+=3;
                if(this.countPagination>=this.arrayAppl.length){
                    this.trigerPagin=true;
                }
            },
            notPagination(){
                this.countPagination=3;
                this.trigerPagin=false;
            },
            checkPagin(){
                if(this.countPagination<this.arrayAppl.length){
                    this.trigerGlobalPagin=true;
                }
            }
        },
        mounted(){
            this.checkPagin();
        }
    }
</script>
<style>
.d-noneInput{
    display: none !important;
}
</style>
