<template>
    <div class="wrap">
        <div class="mt-2 d-flex align-items-start justify-content-between" :class="{
            'flex-column':windowWidth<=720}">
            <div class="usersView" :class="{'w-50':windowWidth>720, 'mr-4':windowWidth>1080, 'mr-2':(windowWidth<=1080 && windowWidth>720)}">
                <h3 class="text-center"><b>Структурные подразделения</b></h3>
                <hr>
                <input type="text" name="searchUsers" id="searchUsers" class="form-control mb-2" placeholder="Поиск отделений" @keyup="getSearchGroup" v-model="textSearch">
                <div class="globalUserWrap">
                    <div class="wrapUser" v-for="(group,index) in groupsData" :value="group.id" >
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">{{ group.name }}</p>
                            <div class="crud_button h-100 d-flex align-items-center justify-content-around" :class="(windowWidth>1080) ? 'w-50' : 'w-25'">
                                <button v-if="windowWidth<=1080" type="submit" @click.prevent="changeGroupInForm(index)" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>
                                <button v-if="windowWidth<=1080" type="submit" @click.prevent="removeGroup(index)" class="btn">
                                    <svg fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                                <button v-if="(windowWidth>1080)" type="submit" @click.prevent="changeGroupInForm(index)" class="btn btn-primary">Изменить</button>
                                <button v-if="(windowWidth>1080)" type="submit" @click.prevent="removeGroup(index)" class="btn btn-danger">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="buttonImportExp d-flex align-items-end justify-content-between" :class="(windowWidth<=1080 && windowWidth>720) ? 'flex-wrap':''">
                    <div class="mb-3 fileImport">
                        <label for="formFile" class="form-label">Выберите файл для импорта</label>
                        <input class="form-control field addition" name="file" ref="file" type="file" id="formFile" @change="changeMessage()">
                    </div>
                    <button v-if="(windowWidth<=720)" type="submit" @click.prevent="importFile()" class="btn btn-primary btn-adaptiv-import mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
                        </svg>
                    </button>
                    <button v-if="(windowWidth<=720)" type="submit" @click.prevent="exportFile()" class="btn btn-primary btn-adaptiv-export mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>
                    <button v-if="(windowWidth>720)" type="submit" @click.prevent="importFile()" class="btn btn-primary btn-import mb-3">
                        Импорт
                    </button>
                    <button v-if="(windowWidth>720)" type="submit" @click.prevent="exportFile()" class="btn btn-primary btn-export mb-3">
                        Экспорт
                    </button>
                </div>
            </div>
            <div class="form_users" :class="{'w-50':windowWidth>720, 'ml-5':windowWidth>1080, 'ml-2':(windowWidth<=1080 && windowWidth>720)}">
                <h3 v-if="trigerChange" class="text-center"><b>Форма изменения</b></h3>
                <h3 v-if="!trigerChange" class="text-center"><b>Форма добавления</b></h3>
                <form>
                    <div class="mb-3">
                        <label for="department" class="form-label"><b>Название отделения</b></label>
                        <br>
                        <textarea :class="((trigerChangeNameForm & v$.formGroup.name.$invalid)) ? 'errorMessag' : '' " v-model="formGroup.name" class="form-control" id="department"></textarea>
                        <span v-if="(trigerChangeNameForm & v$.formGroup.name.maxLength.$invalid)" class="text-danger">Максимально длина 255 символов</span>
                        <span v-if="(trigerChangeNameForm & v$.formGroup.name.required.$invalid)" class="text-danger">Поле должно быть заполнено</span>
                        <span v-if="(trigerChangeNameForm & v$.formGroup.name.minLength.$invalid)" class="text-danger">Минимальная длина 5 символов</span>
                    </div>
                    <button v-if=!trigerChange @click.prevent="addGroup()" type="submit" class="btn btn-primary">Добавить отделение</button>
                    <button v-if=trigerChange @click.prevent="changeGroup(formGroup.id)" type="submit" class="btn btn-primary">Изменить отделение</button>
                </form>
                <h4 class="text-centr mt-3"><b>Должности структурного подразделения</b></h4>
                <div class="globalPostWrap">
                    <div class="wrapUser" v-for="(post,index) in postData" :value="post.id" >
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75" :class="(windowWidth<=1080) ? 'mr-1' : ''">{{ post.name }}</p>
                            <div class="crud_button h-100 d-flex align-items-center justify-content-around" :class="{ 'w-50':windowWidth>1080, 'w-25':windowWidth>720 ,'mr-2':windowWidth<=1080}">
                                <button v-if="windowWidth<=1080" type="submit" @click.prevent="changePost(index)" class="btn mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>
                                <button v-if="windowWidth<=1080" type="submit" @click.prevent="removePost(index)" class="btn mb-3">
                                    <svg fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                                <button v-if="(windowWidth>1080)" type="submit" @click.prevent="changePost(index)" class="btn btn-primary mb-3">Изменить</button>
                                <button v-if="(windowWidth>1080)" type="submit" @click.prevent="removePost(index)" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <button @click.prevent="addPost()" type="submit" class="btn btn-primary btn-primary-users">Добавить должность</button>
                <button @click.prevent="clearForm()" type="submit" class="btn btn-danger btn-danger-users">Очистить форму</button>
            </div>

        </div>
    </div>
</template>
<script>
    import { useVuelidate } from '@vuelidate/core'
    import {required, minLength, maxLength}  from '@vuelidate/validators'
    import swal from 'sweetalert';

    export default{
        setup(){
            return{
                v$:useVuelidate()
            }
        },
        props:[
            'groupinfo',
            'token'
        ],
        data(){
            return{
                //name, id. Использовать в цикле на wrapUser
                groupsData:this.$props.groupinfo,
                trigerChange:false,
                formGroup:{
                    id:'',
                    name:'',
                },
                textSearch:'',
                postData:[],
                // потом почистить и заполнять при изменении групп
                trigerChangeNameForm:false,
                trigerPostFill:false,
                globalIndex:'',
                trigerIdForm:false,
                windowWidth: window.innerWidth
            }

        },
        methods:{
            removePost(index){
                swal({
                    title:'Уверены, что хотите удалить должность?',
                    icon:'warning',
                    buttons:{
                        sucsess:{
                            text:'Да',
                            value:true
                        },
                        def:{
                            text:'Нет',
                            value:false
                        }
                    }
                }).then((answer)=>
                {
                    if(answer){
                        axios.post('/api/admin/destroyPost',{'id':this.postData[index].id,'token':this.$props.token}).then((response)=>{
                            swal('Должность успешно удалена!', '', 'success');
                            this.postData.splice(index,1);
                        })
                    }
                });
            },
            changePost(index){
                var contentInput="";
                this.postData.forEach((element,indexEl ) => {
                    if(indexEl===index){
                        contentInput=element.name;
                    }
                });
                swal({
                    title:'Введите название должности',
                    content: {
                        element: "input",
                        attributes: {
                            value: contentInput
                        },
                    },
                }).then(
                    (name)=>{
                        if(name){
                            axios.post('/api/admin/changePost',{'name':name,'id':this.postData[index].id,'token':this.$props.token}).then((response)=>{
                                swal('Должность успешно изменена!', '', 'success');
                                this.postData[index].name=name;
                            });
                        }else{
                            swal({
                                title: 'Поле должно быть изменено',
                                icon:'warning'
                            });
                        }
                    }
                );
            },
            exportFile(){
                axios.post('/api/admin/downloadGroupsAndParts', {
                }, {
                    responseType: 'blob'
                }).then((response) => {
                    const url = URL.createObjectURL(new Blob([response.data], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    }))
                    const link = document.createElement('a')
                    link.href = url
                    link.setAttribute('download', 'GroupsAndParts')
                    document.body.appendChild(link)
                    link.click()
                });
            },
            changeGroupInForm(index){
                this.trigerChange=true;
                this.trigerIdForm=true;
                this.formGroup.id=this.groupsData[index].id;
                this.formGroup.name=this.groupsData[index].name;
                this.trigerPostFill=true;
                this.globalIndex=index;
                // axios на доставку одного подразделения(тип name, department_part_id)
                // name.split(' ') и по очерёдно присваиваем к formGroup
            },
            getPostGroup(id){
                axios.post('/api/admin/getPostGroup',{'id':id,'token':this.$props.token}).then((response)=>{
                    this.postData=response.data;
                });
            },
            changeGroup(idGroup){
                // axios на изменение
                if(this.v$.formGroup.$invalid && this.trigerPostFill){
                    this.trigerChangeNameForm=true;
                }
                else{
                    this.trigerChange=false;
                    axios.post('/api/admin/changeGroup',{'id':this.formGroup.id,'token':this.$props.token,'name':this.formGroup.name}).then((response)=>{
                        swal('Группа успешно изменена','','success').then(
                            (result)=>{
                                this.groupsData[this.globalIndex]=response.data;
                            this.clearForm();
                            //window.location.reload();
                            }
                        );
                    });
                }
            },
            clearForm(){
                this.formGroup={
                    id:'',
                    name:'',
                };
                this.postData=[];
                this.textSearch='';
                this.trigerChange=false;
                this.trigerChangeNameForm=false;
                this.trigerPostFill=false;
            },
            removeGroup(index){
                let answer=confirm('Точно хотите удалить отделение '+this.groupsData[index].name);
                if(answer){
                    let answer2=confirm('Эти действия необратимы. Всё равно удалить?');
                    if(answer2){
                        swal('Хорошо, удаляем.').then(
                            setInterval(function(){
                            axios.post('/api/admin/destroyGroup',{'id':this.groupsData[index].id,'token':this.$props.token}).then((response)=>{
                                swal('Запись успешно удалена','','success');
                                this.groupsData.splice(index,1);
                            })},1500)
                        );
                    }
                }
            },
            addGroup(){
                // axios на добавлени
                if(this.v$.formGroup.$invalid && !this.trigerPostFill){
                    // alert('да, но как бы нет');
                }
                else{
                    // alert('нет, но как бы да');
                    axios.post('/api/admin/addGroup',{'name':this.formGroup.name,'token':this.$props.token}).then((response)=>{
                        swal('Группа успешно добавлена','','success');
                        this.groupsData.push(response.data);
                        this.clearForm();
                    });
                }
            },
            importFile(){
                if(this.$refs.file!=null){
                    let data=new FormData();
                    data.append('file',this.$refs.file.files[0])
                    axios.post('/api/admin/importGroupsAndPosts',data/*,config*/).then((response)=>{
                        swal('Добавление прошло успешно!', '', 'success').then(
                            setInterval(
                                function(){
                                    window.location.reload();
                                }, 2000
                            )
                        );
                    });
                }
                else{
                    swal("Файл не выбран.",'','warning');
                }
            },
            changeMessage(){
                if(this.$refs.file!=null){
                    this.file=this.$refs.file.files[0];
                    let countFiles = '';
                    if (this.file)
                        countFiles = this.file.name;
                    if (countFiles)
                    {}
                    else
                    swal("Файл не выбран.", '','warning');
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
                    if(this.formGroup.name!='' && this.formGroup.id!=''){
                        swal({
                            title:'Введите название новой должности.',
                            content:'input'
                        }).then((postName)=>{
                            if(postName){
                                axios.post('/api/admin/addPost',{'id':this.formGroup.id,'token':this.$props.token,'name':postName}).then((response)=>{
                                    swal('Должность успешно добавлена!','','success');
                                    this.postData.push(response.data);
                                });
                            }else{
                                swal({
                                    title: 'Поле должно быть заполненно',
                                    icon:'warning'
                                });
                            }
                        });
                    }
                    else{
                        swal('Нужно выбрать группу!','','warning');
                    }
                }
        },
        mounted(){
            // axios на запрос всех отделений (id, name) и циклов выводится в select
            window.onresize = () => {
                this.windowWidth = window.innerWidth
            };
        },
        watch: {
            formGroup:{
                deep: true,
                handler(data){
                    if(data.name && !this.trigerChange){
                        this.trigerChangeNameForm=true;
                    }
                    if(data.id && this.trigerIdForm){
                        this.getPostGroup(this.formGroup.id);
                        this.trigerIdForm=false;
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
.form_users h4 {
    font-size: 0.9rem;
}
@media screen and (max-width:720px){
    .addition {
        height: 36.5px;
        border-radius: 0.25rem 0 0 0.25rem;
        width: 100%;
    }
    .buttonImportExp>div {
        width: 100%;
    }
    .btn-adaptiv-import{
        border-radius: 0 ;
    }
    .btn-adaptiv-export{
        border-radius: 0 0.25rem 0.25rem 0  ;
    }
    form button{
        margin-bottom: 10px;
    }
}
@media screen and (max-width:1080px){
    .buttonImportExp .btn{
        width: 50%;
    }
    .btn-import{
        border-radius: 0.25rem 0 0 0.25rem;
    }
    .btn-export{
        border-radius: 0 0.25rem 0.25rem 0;
    }
    .btn-primary-users{
        width: 43%;
    }
    .btn-danger-users{
        width: 56%;
    }
}
@media screen and (max-width:992px) {
    .btn-primary-users{
        width: 100%;
    }
    .btn-danger-users{
        width: 100%;
    }
}
</style>
