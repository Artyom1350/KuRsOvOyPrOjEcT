<template>
    <div class="wrap">

    <form class=" d-block w-50 m-auto" enctype="multipart/form-data">
        <!--     -->
        <div class="mb-3">
            <label for="nameApplicate" class="form-label">Название:</label>
            <input  type="text" class="form-control" readonly id="nameApplicate" name="nameAppl" placeholder="Название" v-model="nameAppl">
        </div>
        <!-- описание -->
        <div class="mb-3">
            <label for="descripApplicate" class="form-label">Описание:</label>
            <textarea class="form-control" name="descripAppl" readonly id="descripApplicate" rows="3" placeholder="Описание" v-model="descriptionAppl"></textarea>
            
        </div>
        <!-- дата -->
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Срок выполнения до:</label>
            <input type="date" class="form-control" id="dateApplicate" readonly name="dateAppl" placeholder="Дата" v-model="dateAppl">
        </div>
        <a :href="'/myAppl/Download/'+this.$props.applic.doc_id"><input type="button" class="btn btn-primary" value="Скачать файл"/></a>
        <!-- при условии, что пользователь является создателем(передача тригера через laravel) -->
    </form>
</div>
    
</template>

<script>
    export default {
        props:[
            "applic"
        ],
        data(){
            return{
                nameAppl:this.$props.applic.title,
                descriptionAppl:this.$props.applic.description,
                dateAppl:this.$props.applic.dateAppl,
                peopleSelect:[],
                groupSelect:[],
                file:this.$props.applic.fileName,
            }
        }, 
    }
</script>

<style>
    .wrap-grpeo>p{
        border-bottom: 2px solid #000;
    }
    .wrap-grpeo div{
        border: 2px solid #ced4da;
        padding: 0 20px  0 20px ;
        border-radius: 15px;
    }
    .wrap-grpeo div input{
        margin-top: auto;
        margin-bottom: auto;
    }
    .field__wrapper {
        width: 100%;
        position: relative;
        text-align: center;
    }
    .field__file {
        opacity: 0;
        visibility: hidden;
        position: absolute;
    }
    .field__file-wrapper {
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
            -ms-flex-pack: justify;
                justify-content: space-between;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin: 0;
            line-height: 1.6;
    }
    .field__file-fake {
        width: calc(100% - 130px);
        padding: 5px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        border: 2px solid #ced4da;
        border-radius: 15px 0 0 15px;
        border-right: none;
    }
    .field__file-button {
        width: 130px;
        height: 100%;
        background: #3490dc;
        color: #fff;
        border-color: #3490dc;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        cursor: pointer;
    }
    .field__file-button:hover{
        background: #28679b !important;
        border-color: #28679b !important;
        color: #fff;
    }
    .field__file-button-remove{
        border-radius: 0 15px 15px 0 !important;
    }
</style>