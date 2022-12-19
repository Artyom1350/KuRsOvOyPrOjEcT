<template>
    <form class=" d-block w-50 m-auto ">
        <div class="mb-3">
            <label for="nameApplicate" class="form-label">Название:</label>
            <input type="text" class="form-control" id="nameApplicate" name="nameAppl" placeholder="Название">
        </div>
        <div class="mb-3">
            <label for="descripApplicate" class="form-label">Описание:</label>
            <textarea class="form-control" name="descripAppl" id="descripApplicate" rows="3" placeholder="Описание"></textarea>
        </div>
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Срок выполнения до:</label>
            <input type="date" class="form-control" id="dateApplicate" name="dateAppl" placeholder="Дата">
        </div>
        <div class="mb-3">
            <!-- прикрепление нескольких человек -->
            <label for="dateApplicate" class="form-label">Получатель/Получатели:</label>
            <div class="d-flex align-items-start justify-content-between">
                <div class="peopleOrGroup">

                </div>
                <!-- вызов модального окна для выбора человек/групп людей -->
                <input type="button" class="btn btn-primary" value="+"/>
            </div>
        </div>
        <div class="mb-3">       
            <input ref="file" name="file" type="file" id="field__file-2" class="field field__file" v-on:change="changeMessage()">
            <label class="field__file-wrapper" for="field__file-2">
                <div class="field__file-fake">{{ message }}</div>
                <div class="field__file-button field__file-button-add">Выбрать</div>
            </label>
            <input type="button" class="btn btn-danger" value="Отменить выбор" v-on:click="delFile()"/>
        </div>  
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
    
</template>

<script>
    import vuelidator from '@vuelidate/core';
    import {required}  from '@vuelidate/validators'

    export default {
        mounted() {
        },
        props: [],
        data(){
            return{
                nameAppl:'',
                descriptionAppl:'',
                dateAppl:'',
                recipients:[],
                file:'',
                message:'Файл заявки не выбран'
            }
        },
        methods:{
            changeMessage(){

                if(this.$refs.file!=null){

                    this.file=this.$refs.file.files[0];
                    console.log(this.$refs.file.files);

                    let countFiles = '';
                    if (this.file)
                        countFiles = this.file.name;
                    if (countFiles)
                        this.message= 'Выбран файл: ' + countFiles;
                    else
                        this.message = 'Файл заявки не выбран';
                }
                else{

                    this.$refs.file=$('.field')[0];
                    this.$refs.file.files=null;
                    console.log(this.$refs.file.files[0]);

                    this.changeMessage();
                }
                
            },
            delFile(){

                this.$refs.file=null;

                this.changeMessage();
            }
        },
        validations (){
            return{

            }
        }
    }
</script>

<style>
    .field__wrapper {
        width: 100%;
        position: relative;
        margin: 15px 0;
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
    }
    .field__file-fake {
        height: 30px;
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
        height: 30px;
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
        border-radius: 0 15px 15px 0;
        cursor: pointer;
    }
    .field__file-button-remove{
        border-radius: 0;
        background: #dc3448;
        border-color: #dc3448;

    }
</style>