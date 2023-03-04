<template>
    <div class="wrap">

    <form class=" d-block m-auto" :class="(this.windowWidth>1080) ? 'w-50' : ''" enctype="multipart/form-data">
        <!--Название-->
        <div class="mb-3">
            <label for="nameApplicate" class="form-label">Название:</label>
            <input :class="((trigersField.name && (v$.nameAppl.required.$invalid||v$.nameAppl.minLength.$invalid||v$.nameAppl.maxLength.$invalid)) ? 'is-invalid' : '')"  type="text" class="form-control" id="nameApplicate" name="nameAppl" placeholder="Название" v-model="nameAppl">
            <span v-if="v$.nameAppl.required.$invalid" class="invalid-feedback ">Поле должно быть заполнено</span>
            <span v-if="v$.nameAppl.minLength.$invalid" class="invalid-feedback ">Поле должно быть заполнено не менее 10 символов</span>
            <span v-if="v$.nameAppl.maxLength.$invalid" class="invalid-feedback ">Поле должно быть заполнено не более 100 символов</span>

        </div>
        <!-- описание -->
        <div class="mb-3">
            <label for="descripApplicate" class="form-label">Описание:</label>
            <textarea class="form-control" name="descripAppl" id="descripApplicate" rows="3" placeholder="Описание" v-model="descriptionAppl" :class="(trigersField.descr && (v$.descriptionAppl.maxLength.$invalid || v$.descriptionAppl.required.$invalid) ? 'is-invalid' : '')"></textarea>
            <span v-if="v$.descriptionAppl.maxLength.$invalid" class="invalid-feedback ">Поле должно быть заполнено не более 255 символами</span>
            <span v-if="v$.descriptionAppl.required.$invalid" class="invalid-feedback ">Поле должно быть заполнено</span>
            
        </div>
        <!-- дата -->
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Срок выполнения до:</label>
            <input type="date" class="form-control" id="dateApplicate" name="dateAppl" placeholder="Дата" v-model="dateAppl" :class="(((trigersField.date && v$.dateAppl.required.$invalid) || incorrectDate) ? 'is-invalid' : '')">
            <span v-if="v$.dateAppl.required.$invalid" class="invalid-feedback ">Дата должна быть выставлена</span>
            <span v-if="incorrectDate" class="invalid-feedback ">Дата должна быть выставлена корректно <br> (минимум 2-3 дня на выполнение и воскресенье не рабочий день)</span>
        </div>
        <!-- получатели -->
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Получатель/Получатели:</label>
            <div class="d-flex align-items-start justify-content-between">
                <div class="peopleOrGroup w-75">
                    <div v-if="groupSelect[0]" class="wrap-grpeo">
                        <p class="text-center"><b>Группы пользователей</b></p>
                        <div class="mb-3 d-flex justify-content-between" v-for="(group,index) in groupSelect">
                            <p>{{group.name}}</p>
                            <input type="button" class="btn btn-danger" value="-" @click="delElemGroup(index)"/>
                        </div>
                    </div>
                    <div v-if="peopleSelect[0]" class="wrap-grpeo">
                        <p class="text-center"><b>Пользователи</b></p>
                        <div class="mb-3 d-flex justify-content-between " v-for="(group,index) in peopleSelect">
                            <p>{{group.name}}</p>
                            <input type="button" class="btn btn-danger" value="-" @click="delElemPeople(index)"/>
                        </div>
                    </div>
                    <div v-if="!issetGroupPeopl">
                        <p class="text-center"> <b> Никто не выбран</b></p>
                    </div>
                </div>
                <input type="button" class="btn btn-primary" value="+" @click="openModal()"/>
            </div>

        </div>
        <!-- файл -->
        <div class="mb-3 d-flex" >       
            <input accept=".pdf" ref="file" name="file" type="file" id="field__file-2" class="field field__file" @change="changeMessage()">
            <label  class="field__file-wrapper" for="field__file-2">
                <div :class="(((trigersField.file && v$.file.required.$invalid) || incorrectFile) ? 'errorMessage' : 'field__file-fake')">{{ message }}</div>
                <div v-if="(windowWidth<=720)" class="field__file-button field__file-button-add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </div>
                <div v-if="(windowWidth>720)" class="field__file-button field__file-button-add">Выбрать</div>
            </label>
            <input v-if="(windowWidth<=720)" type="button" class="btn btn-danger field__file-button-remove" value="X" @click="delFile()"/>
            <input v-if="(windowWidth>720)" type="button" class="btn btn-danger field__file-button-remove" value="Отменить выбор" @click="delFile()"/>
        </div>  
        <span v-if=" trigersField.file && v$.file.required.$invalid" class="invalid-feedbackCustom">Поле должно быть заполнено</span>
        <span v-if=" trigersField.file && incorrectFile" class="invalid-feedbackCustom">Неверный формат файла <br> Должен быть pdf</span>
        <button type="submit" class="btn btn-primary" @click.prevent="getAnswerApplic()">Добавить</button>
    </form> 
    <ModalWindow v-if="isModalOpen" @close="isModalOpen=false" :groupSelectParrent="groupSelect" :peopleSelectParrent="peopleSelect" @udpadeParrentArray="updateArrays"></ModalWindow>
</div>
    
</template>

<script>
    import swal from 'sweetalert';
    import { useVuelidate } from '@vuelidate/core'
    import {required, minLength, maxLength}  from '@vuelidate/validators'
    import ModalWindow from '../modalWindows/ModalWindowPeople.vue';

    export default {
        setup(){
            return{
                v$:useVuelidate()
            }
        },  
        mounted() {
            this.control=$('#field__file-2')[0];
            window.onresize = () => {
                this.windowWidth = window.innerWidth
            }
        },
        components:{
            ModalWindow
        },
        data(){
            return{
                trigersField:{
                    name:false,
                    descr:false,
                    date:false,
                    file:false
                },
                nameAppl:'',
                descriptionAppl:'',
                dateAppl:'',
                peopleSelect:[],
                groupSelect:[],
                file:null,
                message:'Файл заявки не выбран',
                isModalOpen:false,
                issetGroupPeopl:false,
                incorrectDate:false,
                incorrectFile:false,
                windowWidth: window.innerWidth
            }
        },
        watch:{
            peopleSelect(){
                if(this.groupSelect[0]||this.peopleSelect[0]){
                    this.issetGroupPeopl=true;
                }
                else{
                    this.issetGroupPeopl=false;
                }
            },
            groupSelect(){
                if(this.peopleSelect[0]||this.groupSelect[0]){
                    this.issetGroupPeopl=true;
                }
                else{
                    this.issetGroupPeopl=false;
                }
            },
            nameAppl(){
                this.trigersField.name=true
            },
            descriptionAppl(){
                this.trigersField.descr=true
            },
            dateAppl(oldValue, newValue){
                var date1 = new Date(oldValue.split('-')[0],oldValue.split('-')[1]-1,oldValue.split('-')[2]);
                var date2 = new Date();
                if(date1.getDay()!=0){
                    if((date1 - date2)<0){
                        this.incorrectDate=true
                    }else{
                        let daysMin=date1-date2;
                        if(daysMin<210000000){
                            this.incorrectDate=true
                        }else{
                            this.incorrectDate=false
                        }
                    }   
                }
                else{
                    this.incorrectDate=true
                }
                this.trigersField.date=true

            },
            file(){
                if(this.$refs.file.files[0]){
                    if(this.$refs.file.files[0].name.split('.')[1] != 'pdf'){
                        this.incorrectFile=true
                    }
                    else{
                        this.incorrectFile=false
                    }
                }else{
                    this.incorrectFile=true
                } 
            this.trigersField.file=true
            },
        },  
        methods:{
            changeMessage(){

                if(this.$refs.file!=null){

                    this.file=this.$refs.file.files[0];

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

                    this.changeMessage();
                }
                
            },
            delFile(){
                $('#field__file-2')[0].value = '';
                this.changeMessage();
            },
            openModal(){
                this.isModalOpen=true;
            },
            updateArrays(data){
                this.groupSelect=data.groupSelectChild;
                this.peopleSelect=data.peopleSelectChild;
            },
            delElemGroup(index){
                this.groupSelect.splice(index,1);
            },
            delElemPeople(index){
                this.peopleSelect.splice(index,1);
            },
            getAnswerApplic(){
                if(!this.incorrectDate && this.issetGroupPeopl && !this.v$.$invalid){
                    var peopleMas=new Array();
                    this.peopleSelect.forEach(item => {
                        peopleMas.push(item['id']);
                    });

                    var groupMas=new Array();
                    this.groupSelect.forEach(item=>{
                        groupMas.push(item['id']);
                    })

                    const config = { 'content-type': 'multipart/file.type' }
                    var form=new FormData();
                    form.append('nameAppl',this.nameAppl);
                    form.append('descriptionAppl',this.descriptionAppl);
                    form.append('dateAppl',this.dateAppl);
                    form.append('peopleSelect', peopleMas);
                    form.append('groupSelect',groupMas);
                    form.append('file',this.file);
                    form.append('fileName',this.file.name);
                    axios.post('/myAppl/addApplication',form,config)
                    .then(response=>
                        this.getAnswer()
                    );
                }else{
                    swal('Ошибка выполнения запроса.','Проверьте заполненность всех полей, выбора получателей и выбор файла', "error",{button:'Хорошо'});
                    this.trigersField.name=true;
                    this.trigersField.descr=true,
                    this.trigersField.date=true,
                    this.trigersField.file=true
                }
            },  
            getAnswer(){
                swal('Заявка успешно создана!','', "success")
                .then((val)=>{
                    window.location.href='/myAppl'
                });
            }
        },
        validations (){
            return{
                nameAppl:{
                    required,
                    minLength: minLength(10),
                    maxLength: maxLength(100)
                },
                descriptionAppl:{
                    maxLength: maxLength(255),
                    required
                },
                dateAppl:{
                    required
                },
                file:{
                    required,
                },
            }
        }
    }
</script>

<style>
    .errorMessageGroup{
        border: 2px solid red;
        border-radius: 15px;
        
    }
    .errorMessage{
        border: 2px solid red;
        width: calc(100% - 130px);
        padding: 5px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        border-radius: 15px 0 0 15px;
        border-right: none;
    }
    .invalid-feedbackCustom{
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #e3342f;
    }
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
    @media screen and (max-width:720px) {
        form>button{
            width: 49%;
        }
        .field__file-fake {
            width: calc(100% - 15%);
        }
        .field__file-button{
            width: 15%;
        }
        .field__file-wrapper {
            width: 85%;
        } 
        .field__file-button-remove{
            width: 15%;
        }
    }
</style>