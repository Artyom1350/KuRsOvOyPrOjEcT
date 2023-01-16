<template>
    <div class="wrap">
        
    <form class=" d-block w-50 m-auto" enctype="multipart/form-data">
        <!--     -->
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
            <textarea class="form-control" name="descripAppl" id="descripApplicate" rows="3" placeholder="Описание" v-model="descriptionAppl" :class="(trigersField.descr && v$.descriptionAppl.maxLength.$invalid ? 'is-invalid' : '')"></textarea>
            <span v-if="v$.descriptionAppl.maxLength.$invalid" class="invalid-feedback ">Поле должно быть заполнено не более 255 символами</span>
            
        </div>
        <!-- дата -->
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Срок выполнения до:</label>
            <input type="date" class="form-control" id="dateApplicate" name="dateAppl" placeholder="Дата" v-model="dateAppl" :class="(((trigersField.date && v$.dateAppl.required.$invalid) || incorrectDate) ? 'is-invalid' : '')">
            <span v-if="v$.dateAppl.required.$invalid" class="invalid-feedback ">Дата должна быть выставлена</span>
            <span v-if="incorrectDate" class="invalid-feedback ">Дата должна быть выставлена корректно <br> (минимум 2 дня на выполнение и воскресенье не рабочий день)</span>
        </div>
        <!-- получатели -->
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Получатель/Получатели:</label>
            <div class="d-flex align-items-start justify-content-between">
                <div class="peopleOrGroup w-75">
                    <div v-if="groupSelect[0]" class="wrap-grpeo">
                        <p class="text-center"><b>Группы пользователей</b></p>
                        <div class="mb-3 d-flex justify-content-between" v-for="(group,index) in groupSelect">
                            <p>{{group}}</p>
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
        <p>Ранее выбранный файл: <a :href="'/myAppl/Download/'+this.$props.doc[0].id"> {{ this.$props.doc[0].file }}</a></p>
        <div class="mb-3 d-flex" > 
            <input accept=".pdf" ref="file" name="file" type="file" id="field__file-2" class="field field__file" @change="changeMessage()">
            <label  class="field__file-wrapper" for="field__file-2">
                <div :class="(((trigersField.file && v$.file.required.$invalid) || incorrectFile) ? 'errorMessage' : 'field__file-fake')">{{ message }}</div>
                <div class="field__file-button field__file-button-add">Выбрать</div>
            </label>
            <input  type="button" class="btn btn-danger field__file-button-remove" value="Отменить выбор" @click="delFile()"/>
        </div>  
        <span v-if=" trigersField.file && v$.file.required.$invalid" class="invalid-feedbackCustom">Поле должно быть заполнено</span>
        <span v-if=" trigersField.file && incorrectFile" class="invalid-feedbackCustom">Неверный формат файла <br> Должен быть pdf</span>
        <button type="submit" class="btn btn-primary" @click.prevent="getAnswerApplic()">Сохранить</button>
    </form>
    <ModalWindow v-if="isModalOpen" @close="isModalOpen=false" :groupSelectParrent="groupSelect" :peopleSelectParrent="peopleSelect" @udpadeParrentArray="updateArrays"></ModalWindow>

</div>
    
</template>

<script>
    import { assertExistsTypeAnnotation } from '@babel/types';
    import { useVuelidate } from '@vuelidate/core'
    import {required, minLength, maxLength}  from '@vuelidate/validators'
    import ModalWindow from '../ModalWindowPeople.vue';


    export default {
        setup(){
            return{
                v$:useVuelidate()
            }
        },  
        mounted() {
            this.control=$('#field__file-2')[0];
        },
        components:{
            ModalWindow
        },
        props:['doc','users','path','fileName'],
        data(){
            return{
                trigersField:{
                    name:false,
                    descr:false,
                    date:false,
                    file:false
                },
                nameAppl:this.$props.doc[0].title,
                descriptionAppl:this.$props.doc[0].description,
                dateAppl:this.$props.doc[0].dateAppl,
                peopleSelect:this.$props.users,
                groupSelect:[],
                file:'',
                message:'Файл заявки не выбран',
                isModalOpen:false,
                issetGroupPeopl:false,
                incorrectDate:false,
                incorrectFile:false
            }
        },
        created(){
            //не рабочая дичь (файл получается битый)
           /* var reader=new FileReader();
            data=fetch(this.$props.path);
            console.log(this.$props.path);
            console.log(data)
            var file1=new File(this.$props.path,this.$props.docName);
            console.log(file1);
            this.file=file1;
            var form=new FormData();
            form.append('path',this.$props.path)
            axios.post('/getDocument',form).then((response)=>{

                const blob = new Blob([response],{type: "application/json"});
                var file1=new File([blob], this.$props.doc[0].file);

                проверка
                var url=URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.setAttribute('href', url);
                link.setAttribute('download', this.$props.doc[0].file);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                console.log(file1);
                console.log(blob);
                this.file=file;
                console.log(response)
                
            })*/
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
                        let days = Math.floor((date1 - date2) / (1000 * 60 * 60 * 24) % 30)
                        if(days<2){
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
                console.log(this.file);
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
                this.peopleSelect=data.peopleSelectChild
            },
            delElemGroup(index){
                this.groupSelect.splice(index,1);
            },
            delElemPeople(index){
                this.peopleSelect.splice(index,1);
            },
            getAnswerApplic(){
                /*if(this.incorrectDate && this.issetGroupPeopl && !this.v$.$invalid){
                    alert('Запрос на сервер')
                }else{
                    alert('Ошибка')
                }*/

                var mas=new Array();
                this.peopleSelect.forEach(item => {
                    mas.push(item['id']);
                });

                const config = { 'content-type': 'multipart/file.type' }
                var form=new FormData();
                form.append('nameAppl',this.nameAppl);
                form.append('descriptionAppl',this.descriptionAppl);
                form.append('dateAppl',this.dateAppl);
                form.append('peopleSelect', mas);
                form.append('groupSelect',this.groupSelect);
                form.append('file',this.file);
                form.append('fileName',this.file.name);
                form.append('dateAppl',this.dateAppl);
                form.append('doc_id',this.$props.doc[0].id);
                axios.post('/changeApplSend',form,config)
                .then(response=>console.log(response));
            },  
        },
        validations (){
            return{
                nameAppl:{
                    required,
                    minLength: minLength(10),
                    maxLength: maxLength(100)
                },
                descriptionAppl:{
                    maxLength: maxLength(255)
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
</style>