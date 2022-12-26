<template>
    <div>
        dz
        <p>{{ applic1.userName }}</p>
    </div>
    
</template>
<script> console.log(applic1)</script>
<script>
    export default {
        mounted() {
        },
        props: ['applic'],
        data(){
            return{
                applic1: this.$props.applic
            }
        }
        
    }
    
</script>