<template>
    <div>
        <div v-for="applicat in arrayAppl" :key="applicat.id" class="application d-flex justify-content-between">
            <h3>{{applicat.id}}</h3>
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
        }
    }
</script>
