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
        <div v-for="applicat in mydata">
            <p>{{applicat.id}}</p>
            <p>{{applicat.name}}</p>

        </div>
    </div>
    
</template>

<script>
    export default {
        mounted() {
        },
        props: ['mydata'],
        data(){
            return{
                imgDown:'../../../public/image/icons/arrowdown.svg',
                imgLeft:'../../../public/image/icons/arrowLeft.svg',
                slide: true,
            };
        },
    }
</script>
