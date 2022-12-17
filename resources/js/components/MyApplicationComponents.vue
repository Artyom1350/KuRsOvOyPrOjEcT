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
            <div class="application d-flex justify-content-between" :key="index" v-on:click="">
                <h3>{{applicat.name}}</h3>
                <img class="rounded float-end" v-if="slide[index]" :src="slide[index][1] ? imgDown : imgLeft" alt="Развернуть">
            </div>
            <ul class="applicationSlide" :class="'application'+index+'-slide'">
                <li>
                    <div class="answer d-flex justify-content-between">
                        <h4>Ответ от пользователя</h4>
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
                this.slide.push(['application'+index+'-slide',false]);
            });
            console.log(this.slide[0][1]);
        },
        props: ['mydata'],
        data(){
            return{
                imgDown:'./images/arrowdown.svg',
                imgLeft:'./images/arrowLeft.svg',
                slide:[],
            };
        },methods:{

        }
    }
</script>
