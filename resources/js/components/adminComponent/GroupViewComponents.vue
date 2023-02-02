<template>
    <div class="wrap">
        <div class="d-flex align-items-start justify-content-between">
            <div class="usersView w-50 mr-4">
                <h3 class="text-center">Отделения</h3>
                <hr>
                <input type="text" name="searchUsers" id="searchUsers" class="form-control mb-2" placeholder="Поиск отделений" @keyup="getSearchGroup" v-model="textSearch">
                <div class="globalUserWrap">
                    <div class="wrapUser" v-for="(group,index) in groupsData" :value="group.id" >
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">{{ group.name }}</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="buttonImportExp d-flex align-items-end justify-content-between  ">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Выберите файл для импорта</label>
                        <input class="form-control field addition" name="file" ref="file" type="file" id="formFile" @change="changeMessage()">
                    </div>
                    <button type="submit" @click.prevent="importFile()" class="btn btn-primary mb-3">Импорт</button>
                    <button type="submit" @click.prevent="exportFile()" class="btn btn-primary mb-3">Экспорт</button>
                </div>
            </div>
            <div class="form_users w-50 ml-5">
                <h3 v-if="trigerChange" class="text-center">Форма изменения</h3>
                <h3 v-if="!trigerChange" class="text-center">Форма добавления</h3>
                <form>
                    <div class="mb-3">
                        <label for="department" class="form-label">Название отделения</label>
                        <br>
                        <textarea :class="((trigerChangeNameForm & v$.formGroup.name.$invalid)) ? 'errorMessag' : '' " v-model="formGroup.name" class="form-control" id="department"></textarea>
                        <span v-if="(trigerChangeNameForm & v$.formGroup.name.maxLength.$invalid)" class="text-danger">Максимально длина 255 символов</span>
                        <span v-if="(trigerChangeNameForm & v$.formGroup.name.required.$invalid)" class="text-danger">Поле должно быть заполнено</span>
                        <span v-if="(trigerChangeNameForm & v$.formGroup.name.minLength.$invalid)" class="text-danger">Минимальная длина 5 символов</span>
                    </div>
                    <button v-if=!trigerChange @click.prevent="addGroup" type="submit" class="btn btn-primary">Добавить отделение</button>
                    <button v-if=trigerChange @click.prevent="changeUser(idGroup)" type="submit" class="btn btn-primary">Изменить отделение</button>
                </form>
                <h4 class="text-centr mt-2">Должности</h4>
                <div class="globalPostWrap">
                    <div class="wrapUser" v-for="(post,index) in postData" :value="post.id" >
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">{{ post.name }}</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <button type="submit" @click.prevent="changePost(index)" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removePost(index)" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <button @click.prevent="addPost()" type="submit" class="btn btn-primary">Добавить должность</button>
            </div>
            
        </div>
    </div>
</template>
<script>
    import { useVuelidate } from '@vuelidate/core'
    import {required, minLength, maxLength}  from '@vuelidate/validators'

    export default{
        setup(){
            return{
                v$:useVuelidate()
            }
        }, 
        props:[
            'groupinfo',
        ],
        data(){
            return{
                //name, id. Использовать в цикле на wrapUser
                groupsData:this.$props.groupinfo,
                trigerChange:false,
                formGroup:{
                    name:'',
                },
                idGroup:"",
                textSearch:'',
                postData:[
                    {
                        name:'такое-то 1'
                    },
                    {
                        name:'такое-то 2'
                    },{
                        name:'такое-то 3'
                    },{
                        name:'такое-то 4'
                    },
                ],
                // потом почистить и заполнять при изменении групп
                trigerChangeNameForm:false,
                trigerPostFill:false
            }
            
        },
        methods:{
            removePost(index){
                if(confirm('Точно хотите удалить должность?')){
                    if(confirm('Уверены?')){
                        this.postData.splice(index,1);
                    }
                }
            },
            changePost(index){
                let name=prompt('Введите новое название для должности');
                this.postData[index].name=name;
            },
            changeUserinForm(idUser){
                this.trigerChange=true;
                this.idGroup=idUser;
                this.trigerPostFill=true;
                // axios на доставку одного подразделения(тип name, department_part_id)
                // name.split(' ') и по очерёдно присваиваем к formGroup
            },
            changeUser(idUser){
                // axios на изменение
                if(!this.v$.formGroup.$invalid & this.trigerPostFill){
                    alert('да');
                }
                else{
                    alert('нет');
                }
                this.trigerChange=false;
            },
            removeUser(idUser){
                let answer=confirm('Точно хотите удалить отделение'
                +
                // ФИО пользователя по id
                '');
                if(answer){
                    let answer2=confirm('Эти действия необратимы. Всё равно удалить?');
                    if(answer2){
                        alert('Хорошо, удаляем.');
                        // axios на удаление
                        window.location.reload();
                    }
                }
            },
            addGroup(){
                // axios на добавлени
                if(!this.v$.formGroup.$invalid & this.trigerPostFill){
                    alert('да');
                }
                else{
                    alert('нет');
                }
            },
            importFile(){
                if(this.$refs.file!=null){
                    // запрос на сервер
                }
                else{
                    alert("Файл не выбран.");
                }
            },
            exportFile(){
                
            },
            changeMessage(){    
                if(this.$refs.file!=null){
                    this.file=this.$refs.file.files[0];
                    let countFiles = '';
                    if (this.file)
                        countFiles = this.file.name;
                    if (countFiles)
                        alert("Файл загружен, нажмите 'Импорт', для импорта пользователей.");
                    else
                        alert("Файл не выбран.");
                }
                else{
                    this.$refs.file=$('.field')[0];
                    this.$refs.file.files=null;
                    this.changeMessage();
                }                 
            },
            getSearchGroup(){
                    for( var i=0;i< $('.user').length;i++){
                        var el=$('.user')[i];
                        if(el.outerText.includes(this.textSearch)){
                            el.parentElement.style.display="block"
                        }else{
                            el.parentElement.style.display="none"
                        }
                    }
                },
                addPost(){
                    prompt('чтото');
                }
        },
        created(){
           // this.groupsData=
        },
        mounted(){
            // axios на запрос всех отделений (id, name) и циклов выводится в select
        },
        watch: {
            formGroup:{
                deep: true,
                handler(data){
                    if(data.name){
                        this.trigerChangeNameForm=true;
                    }
                },
            },
            postData(){
                
                if(this.postData==""||this.postData==null){
                    this.trigerPostFill=false;
                }
                else{
                    this.trigerPostFill=true;
                }
            }
        },
        validations (){
            return{
                postData:{
                    required
                },
                formGroup:{
                    name:{
                        required,
                        minLength: minLength(5),
                        maxLength: maxLength(255)
                    }
                }
            }
        },
        
    }
</script>
<style>
.globalUserWrap{
    overflow-y: scroll;
	height: 315px;
}
.addition{
    padding: 0;
    height: 32px;
}
.globalPostWrap{
    overflow-y: scroll;
	height: 212px;
}
.errorMessag{
    border: 2px solid #f00 !important;
}
</style>