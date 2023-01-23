<template>
    <div>
        <div v-for="applicat in arrayAppl" :key="applicat.id" class="application d-flex justify-content-between">
            <h3>{{applicat.userName}}</h3>
            <h3>{{applicat.title}}</h3>
            <a :href="'incAppl/'+applicat.idDocument"><button class="btn btn-primary">Просмотреть заявку</button></a>
        </div>
    </div>
    
</template>

<script>
    export default {
        mounted() {
            console.log(this.$props.incdata);
        },
        props: ['incdata'],
        data(){
            return{
                arrayAppl: this.$props.incdata
            }
        },
        
    }
</script>
