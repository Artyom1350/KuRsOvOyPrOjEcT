<template>
    <div class="wrap">
        <div class="d-flex align-items-start justify-content-between">
            <div class="usersView w-50 mr-4">
                <h3 class="mt-3 text-center">Пользователи</h3>
                <hr>
                <input type="text" name="searchUsers" id="searchUsers" class="form-control mb-2" placeholder="Поиск пользователей" @keyup="getSearchPeople()" v-model="textSearch">
                <div class="globalUserWrap">
                    <div class="wrapUser" v-for="(user,index) in usersData" ><!-- Этот элемент в цикл -->
                        <div class="user d-flex align-items-start justify-content-between">
                            <p class="w-75">{{user.name}}</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-start justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm(user.id)" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser(index)" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="buttonImportExp d-flex align-items-end justify-content-between ">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Выберите файл для импорта</label>
                        <input class="form-control field addition" name="file" ref="file" type="file" id="formFile" @change="changeMessage()">
                    </div>
                    <button type="submit" @click.prevent="importFile()" class="btn btn-primary mb-3">Импорт</button>
                    <button type="submit" @click.prevent="exportFile()" class="btn btn-primary mb-3">Экспорт</button>
                </div>
            </div>
            <div class="form_users w-50 ml-5">
                <h3 class="mt-3 text-center">Форма добавления/изменения</h3>
                <form>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Фамилия</label>
                        <input v-model="formUser.surname" type="text" class="form-control" id="surname">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input v-model="formUser.name" type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" class="form-label">Отчество</label>
                        <input v-model="formUser.patronymic" type="text" class="form-control" id="patronymic">
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" class="form-label">Пароль</label>
                        <input v-model="formUser.password" type="text" class="form-control" id="patronymic">
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" class="form-label">Почта</label>
                        <input v-model="formUser.email" type="email" class="form-control" id="patronymic">
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Отделение</label> <br>
                        <select  v-model="formUser.department" class="form-select form-control" id="department">
                            <!-- цикл для вывода всех отделений -->
                            <option v-for="(department,index) in departmentData" :value="department.id">{{ department.name }}</option>
                        </select>                   
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Должность</label> <br>
                        <select v-model="formUser.post" class="form-select form-control" id="department">
                            <!-- цикл для вывода всех Должностей -->
                            <option v-for="(departmentPart,index) in departmentPartsData" :value="departmentPart.id" >{{ departmentPart.name }}</option>
                        </select>                   
                    </div>
                    <button v-if=!trigerChange @click.prevent="addUser" type="submit" class="btn btn-primary">Добавить</button>
                    <button v-if=trigerChange @click.prevent="changeUser(idUserChange)" type="submit" class="btn btn-primary">Изменить</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { assertExpressionStatement } from '@babel/types';

    export default{
        props:[
            'users',
        ],
        data(){
            return{
                //name, id. Использовать в цикле на wrapUser
                usersData: this.$props.users,
                trigerChange:false,
                formUser:{
                    patronymic:'',
                    surname:'',
                    name:'',
                    department:'',
                    email:'',
                    password:'',
                    post:'',
                    id:'',
                },
                idUserChange:'',
                file:'',
                groupUser:'',
                postsUsers:'',
                textSearch:'',
                token:'',
                departmentData:[],
                departmentPartsData:[],
            }
            
        },
        watch:{
            'formUser.department'(){
                this.getDepartmentParts();
            }
        },  
        methods:{
            changeUserinForm(idUser){
                this.trigerChange=true;
                this.idUserChange=idUser;
                console.log(this.idUserChange);

                var form=new FormData();
                form.append('id',this.idUserChange);
                form.append('token',this.token);

                axios.post('/api/admin/getOneUser',form).then((response)=>{
                    this.formUser.surname=response.data.user.name.split(' ')[0];
                    this.formUser.name=response.data.user.name.split(' ')[1];
                    this.formUser.patronymic=response.data.user.name.split(' ')[2];
                    this.formUser.id=response.data.user.id;
                    this.formUser.email=response.data.user.email;
                    //this.formUser.password=response.data.user.password; пароль нельзя дехешировать так что да
                    this.formUser.post=response.data.user.department_part_id;
                    this.formUser.department=response.data.department;
                    this.getDepartmentParts();
                    console.log(response);
                });

                // axios на доставку одного пользователя(тип name, department_part_id)
                // name.split(' ') и по очерёдно присваиваем к formUser
            },
            //Получение токена
            getToken(){
                axios.post('/admin/token').then((response)=>{
                    //console.log(response.data.token);
                    this.token=response.data.token;
                    this.getDepartment();

                });
            },
            //все департменты
            getDepartment(){
                axios.post('/api/admin/getAllDepartments',{'token':this.token}).then((response)=>{
                this.departmentData=response.data.departments;
             });
            },
            //должности
            getDepartmentParts(){
                axios.post('/api/admin/getDepartmentParts',{'token':this.token,'id':this.formUser.department}).then((response)=>{
                    this.departmentPartsData=response.data.departmentParts;
                    console.log(response);
                });
            },
            changeUser(idUser){
                this.trigerChange=false;
                // axios на изменение
                var form=new FormData();
                let name=this.formUser.surname+" "+this.formUser.name+" "+this.formUser.patronymic;
                form.append('name',name);
                form.append('email',this.formUser.email);
                form.append('password',this.formUser.password);
                form.append('department_part',this.formUser.post);
                form.append('id',this.formUser.id);
                form.append('token',this.token);
                
                axios.post('/api/admin/changeUser',form).then((response)=>{
                    alert(response);
                    window.location.reload();
                });
            },
            removeUser(idUser){
                let answer=confirm('Точно хотите удалить пользователя '
                + this.usersData[idUser].name);
                if(answer){
                    let answer2=confirm('Эти действия необратимы. Всё равно удалить?');
                    if(answer2){
                        alert('Хорошо, удаляем.');
                        // axios на удаление
                        axios.post('/api/admin/destroyUser',{'id':this.usersData[idUser].id,'token':this.token}).then((response)=>{
                            alert(response);
                            window.location.reload();
                        })
                    }
                }
            },
            addUser(){
                let name=this.formUser.surname+" "+this.formUser.name+" "+this.formUser.patronymic;
                var form=new FormData();
                form.append('name',name);
                form.append('email',this.formUser.email);
                form.append('password',this.formUser.password);
                form.append('department_part',this.formUser.post);
                form.append('token',this.token);
                axios.post('/api/admin/addUser',form).then((response)=>{
                    alert(response);
                    location.reload();
                });
                // axios на добавлени
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
            getSearchPeople(){
                    for( var i=0;i< $('.user').length;i++){
                        var el=$('.user')[i];
                        if(el.outerText.includes(this.textSearch)){
                            el.parentElement.style.display="block"
                        }else{
                            el.parentElement.style.display="none"
                        }
                    }
                },

        },
        created(){
            this.getToken();

        },
        mounted(){
            // axios на запрос всех отделений (id, name) и циклов выводится в select


        }
    }
</script>
<style>
.user{
    height: 38px;
}
.globalUserWrap{
    overflow-y: scroll ;
	height: 315px;
}
.addition{
    padding: 0;
    height: 32px;
}
</style>