<template>
    <div>
        <div class="form-group mt-2">
            <input type="text" class="form-control searchString" placeholder="Поиск отделений" name="search" @keyup="getsearch"
            v-model="textSearch">
        </div>

        <div class="wrap-card" v-for="applicat in arrayAppl" :key="applicat.id">
            <div  class="application p-1 h-auto d-flex justify-content-between">
                <h3>{{applicat.userName}}</h3>
                <h3>{{applicat.title}}</h3>
                <a :href="'incAppl/'+applicat.idDocument"><button class="btn btn-primary">Просмотреть заявку</button></a>
            </div>
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
                textSearch:''
            }
        },
        methods:{
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
        }
    }
</script>
