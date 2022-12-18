<template>
    <div>
        <!-- <div class="application d-flex justify-content-between " onclick="slideAppl(1)">
        <h3>Заголовок</h3>
        <img class=" rounded float-end " src="../../../public/image/icons/arrowdown.svg" alt="Развернуть">
        </div>
        <ul class="applicationSlide application1-slide">
            <li>
                <div class="answer d-flex justify-content-between">
                    <h4>Ответ от пользователя</h4>
                    <a href="#"><button class="btn btn-primary">Ссылка на скачивание</button></a>
                </div>
            </li>
        </ul> -->
        <div  class="wrap-card" v-for="(applicat,index) in mydata">
            <div class="application d-flex justify-content-between" :key="index" @click="slideAppl(index)">
                <h3>{{applicat.name}}</h3>
                
                <img class="float-end" :class="slide[index][1] ? 'applicationImgLeft' : 'applicationImgDown'" 
                v-if="slide[index] && applicat.applacationsAnswer"
                :src="slide[index][2]" alt="Развернуть">
                <p v-else>Ответы не предоставлены</p> 
            </div>
            <ul v-if="applicat.applacationsAnswer" class="applicationSlide" :class="'application'+index+'-slide'">
                <li>
                    <div class="answer d-flex justify-content-between">
                        <h4>{{applicat.applacationsAnswer.nameUser}}</h4>
                        <a href="#"><button class="btn btn-primary">Ссылка на скачивание</button></a>
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
            }
        }
    }
</script>
