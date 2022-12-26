<template>
    <div>
        <div v-for="applicat in arrayAppl" :key="applicat.id" class="application d-flex justify-content-between">
            <h3 class="w-50 overflow-hidden">{{applicat.id}}</h3>
            <a href="#"><button class="btn btn-primary">Дать ответ на заявку</button></a>
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
                arrayAppl: this.$props.incdata
            }
        },
        
    }
</script>

<style>
    h3{
        height: 70%;
        text-align: start;
    }
</style>