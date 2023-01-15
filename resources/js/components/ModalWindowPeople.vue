<template>
    <div class="modalWindow">
        <div class="textArea">
            <h2 class='text-center'>Выбор групп пользователей</h2>
            <div class="grupPeople d-flex flex-wrap">
                <div class="form-check mr-3">
                    <input class="form-check-input" type="checkbox" value="Приёмная коммисия" id="selectGroup1" @change="checkArray" v-model='groupSelect'>
                    <label class="form-check-label" for="selectGroup1">
                        Приёмная коммисия
                    </label>
                </div>
                <div class="form-check mr-3">
                    <input class="form-check-input" type="checkbox" value="Учебная часть" id="selectGroup2" @change="checkArray" v-model='groupSelect'>
                    <label class="form-check-label" for="selectGroup2">
                        Учебная часть
                    </label>
                </div>
                
            </div>
            <h2 class='text-center mt-5'>Выбор пользователей</h2>
            <div class="people d-flex flex-wrap">
                <div class="form-check mr-3">
                    <input class="form-check-input" type="checkbox" value="Багина Ксения Евгеньевна" id="selectGroup4" @change="checkArray" v-model='peopleSelect'>
                    <label class="form-check-label" for="selectGroup4">
                        Багина Ксения Евгеньевна
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Аристова Елена Генадьевна" id="selectGroup3" @change="checkArray" v-model='peopleSelect'>
                    <label class="form-check-label" for="selectGroup3">
                        Аристова Елена Генадьевна
                    </label>
                </div>
            </div>
        </div>
        <div class="buttonWrap d-flex align-items-center mt-5">
            <button class="btn btn-primary w-25 " @click="closeModal" :disabled="!disabledButton">Выбрать</button>
            <button class="btn btn-danger w-25 " @click="closeModal">Отмена</button>
        </div>
        
    </div>
</template>

<script>
    export default{
        data(){
            return{
                groupSelect:this.groupSelectParrent,
                peopleSelect:this.peopleSelectParrent,
                disabledButton:false
            }
        },
        mounted(){
            
        },
        props:[
            'groupSelectParrent',
            'peopleSelectParrent'
        ],
        methods:{
            closeModal(){
                this.$emit('close');
            },
            checkArray(){
                if(this.groupSelect[0]!=null || this.peopleSelect[0]!=null){
                    this.disabledButton=true;
                }
                else{
                    this.disabledButton=false;
                }
                this.udpadeParrentArray();
            },
            udpadeParrentArray(){
                this.$emit('udpadeParrentArray', {
                    groupSelectChild: this.groupSelect,
                    peopleSelectChild: this.peopleSelect
                })
            }
        },
    }
</script>

<style>

    .modalWindow{
        width: calc(100% - 500px);
        height: 500px;
        padding: 20px;
        box-shadow: 1px 1px 3000px black;
        position: absolute;
        margin: auto;
        top: 30%;
        left:0;
        right: 0;
        background: #fff;
    }

</style>