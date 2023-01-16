<template>
    <div>
        <div  class="wrap-card" v-for="(applicat,index) in mydata">
            <div class="application d-flex justify-content-between" :key="index" @click="slideAppl(index)">
                <h3>{{applicat.name}}</h3>
                <a :href="'/myAppl/Download/'+applicat.id"><button class="btn btn-primary">Скачать документ</button></a>
                <a :href="'/myAppl/changeApplication/'+applicat.id"><button class="btn btn-primary">Редактировать заявку</button></a>
                <img class="float-end" :class="slide[index][1] ? 'applicationImgLeft' : 'applicationImgDown'" 
                v-if="slide[index] && applicat.applacationsAnswer"
                :src="slide[index][2]" alt="Развернуть">
                <p v-else>Ответы не предоставлены</p> 
            </div>
            <ul v-if="applicat.applacationsAnswer" class="applicationSlide" :class="'application'+index+'-slide'">
                <li>
                    <div class="answer d-flex justify-content-between">
                        <h4>{{applicat.applacationsAnswer.nameUser}}</h4>
                    </div>
                </li>
            </ul>
        </div>
        
    </div>
    
</template>

<script>
    export default {
        mounted() {
            this.mydata.forEach((element,index) => {
                this.slide.push(['application'+index+'-slide',false,this.imgLeft]);
            });
            this.mydata.forEach((element,index) => {
                this.slideAppl(index);
            });
        },
        props: ['mydata'],
        data(){
            return{
                imgDown:'./images/arrowdown.svg',
                imgLeft:'./images/arrowLeft.svg',
                slide:[],
            };
        },methods:{
            slideAppl(idElem){
                $(".application"+idElem+"-slide").slideToggle("fast");

                if(this.slide[idElem][1]){
                    this.slide[idElem][2]= this.imgDown;
                    this.slide[idElem][1]=!this.slide[idElem][1];}
                else
                {
                    this.slide[idElem][2]= this.imgLeft;
                    this.slide[idElem][1]=!this.slide[idElem][1];}
                    
                this.$forceUpdate()
            },
        }
    }
</script>
