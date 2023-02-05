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
                                <button type="submit" @click.prevent="changeGroupInForm(index)" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeGroup(index)" class="btn btn-danger mb-3">Удалить</button>
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
                    <button v-if=!trigerChange @click.prevent="addGroup()" type="submit" class="btn btn-primary">Добавить отделение</button>
                    <button v-if=trigerChange @click.prevent="changeGroup(formGroup.id)" type="submit" class="btn btn-primary">Изменить отделение</button>
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
                <button @click.prevent="clearForm()" type="submit" class="btn btn-danger">Очистить форму</button>
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
                    id:'',
                    name:'',
                },
                textSearch:'',
                postData:[],
                // потом почистить и заполнять при изменении групп
                trigerChangeNameForm:false,
                trigerPostFill:false,
                token:'',
                globalIndex:'',
                trigerIdForm:false
            }
            
        },
        methods:{
            removePost(index){
                if(confirm('Точно хотите удалить должность?')){
                    if(confirm('Уверены?')){
                        axios.post('/api/admin/destroyPost',{'id':this.postData[index].id,'token':this.token}).then((response)=>{
                            alert('Должность успешно удалена!');
                            this.postData.splice(index,1);
                        })
                    }
                }
            },
            changePost(index){

                let name=prompt('Введите новое название для должности');
                axios.post('/api/admin/changePost',{'name':name,'id':this.postData[index].id,'token':this.token}).then((response)=>{
                    alert('Должность успешно изменена!');
                    this.postData[index].name=name;
                });
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
                axios.post('/api/admin/getPostGroup',{'id':id,'token':this.token}).then((response)=>{
                    this.postData=response.data;
                });
            },
            changeGroup(idGroup){
                // axios на изменение
                if(!this.v$.formGroup.$invalid & this.trigerPostFill){
                    alert('да');
                }
                else{
                    alert('нет');
                    axios.post('/api/admin/changeGroup',{'id':this.formGroup.id,'token':this.token,'name':this.formGroup.name}).then((response)=>{
                        alert('Группа успешно изменена');
                        this.groupsData[this.globalIndex]=response.data;
                        this.clearForm();
                        //window.location.reload();
                    });
                }
                this.trigerChange=false;
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
                        alert('Хорошо, удаляем.');
                        axios.post('/api/admin/destroyGroup',{'id':this.groupsData[index].id,'token':this.token}).then((response)=>{
                            alert('Запись успешно удалена');
                            this.groupsData.splice(index,1);
                        });
                    }
                }
            },
            addGroup(){
                // axios на добавлени
                if(!this.v$.formGroup.$invalid & this.trigerPostFill){
                    // alert('да, но как бы нет');
                }
                else{
                    // alert('нет, но как бы да');
                    axios.post('/api/admin/addGroup',{'name':this.formGroup.name,'token':this.token}).then((response)=>{
                        alert('Группа успешно добавлена');
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
                        alert('Добавление прошло успешно!');
                        window.location.reload();
                    });
                }
                else{
                    alert("Файл не выбран.");
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
                        alert("Файл не выбран.");
                }
                else{
                    this.$refs.file=$('.field')[0];
                    this.$refs.file.files=null;
                    this.changeMessage();
                }                 
            },
            getToken(){
                axios.post('/admin/token').then((response)=>{
                    this.token=response.data.token;
                });
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
                        var postName=prompt('Введите название должности');
                        axios.post('/api/admin/addPost',{'id':this.formGroup.id,'token':this.token,'name':postName}).then((response)=>{
                            alert('Должность успешно добавлена!');
                            this.postData.push(response.data);
                        });
                    }
                    else{
                        alert('Нужно выбрать группу!');
                    }
                }
        },
        created(){
            this.getToken();
        },
        mounted(){
            // axios на запрос всех отделений (id, name) и циклов выводится в select
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
</style>