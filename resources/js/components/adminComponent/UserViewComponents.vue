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
                                <button type="submit" @click.prevent="changeUserinForm(user.id, index)" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser(index)" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="mt-3 buttonImportExp d-flex align-items-end justify-content-between ">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Выберите файл для импорта</label>
                        <input class="form-control field addition" name="file" ref="file" type="file" id="formFile" @change="changeMessage()">
                    </div>
                    <button type="submit" @click.prevent="importFile()" class="btn btn-primary mb-3">Импорт</button>
                    <button type="submit" @click.prevent="exportFile()" class="btn btn-primary mb-3">Экспорт</button>
                </div>
            </div>
            <div class="form_users w-50 ml-5">
                <h3 v-if="!trigerChange" class="mt-3 text-center">Форма добавления</h3>
                <h3 v-if="trigerChange" class="mt-3 text-center">Форма изменения</h3>
                <form>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Фамилия</label>
                        <input v-model="formUser.surname" type="text" class="form-control" :class="(( trigerChangesurname & v$.formUser.surname.$invalid)) ? 'is-invalid' : '' "  id="surname">
                        <span class="invalid-feedback" v-if="(trigerChangesurname &  v$.formUser.surname.required.$invalid)">Поле должно быть заполнено</span>                        
                        <span class="invalid-feedback" v-if="(trigerChangesurname & v$.formUser.surname.maxLength.$invalid)">Максимальное количество символов 82</span>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input v-model="formUser.name" type="text" class="form-control" :class="(( trigerChangename & v$.formUser.name.$invalid)) ? 'is-invalid' : '' "  id="name">
                        <span class="invalid-feedback" v-if="(trigerChangename & v$.formUser.name.required.$invalid)">Поле должно быть заполнено</span>                        
                        <span class="invalid-feedback" v-if="(trigerChangename & v$.formUser.name.maxLength.$invalid)">Максимальное количество символов 82</span>
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" class="form-label">Отчество</label>
                        <input v-model="formUser.patronymic" type="text" class="form-control" :class="(( trigerChangepatronymic & v$.formUser.patronymic.$invalid)) ? 'is-invalid' : '' "  id="patronymic">
                        <span class="invalid-feedback" v-if="(trigerChangepatronymic & v$.formUser.patronymic.required.$invalid)">Поле должно быть заполнено</span>                        
                        <span class="invalid-feedback" v-if="(trigerChangepatronymic & v$.formUser.patronymic.maxLength.$invalid)">Максимальное количество символов 82</span>
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" :class="(( trigerChangepassword & v$.formUser.password.$invalid)|| ( trigerChangepassword & !trigerValidPassword)) ? 'is-invalid' : '' " class="form-label">Пароль</label>
                        <input v-model="formUser.password" type="text" class="form-control" id="patronymic">
                        <span class="invalid-feedback" v-if="( trigerChangepassword & v$.formUser.password.required.$invalid)">Поле должно быть заполнено</span>
                        <span class="invalid-feedback" v-if="(trigerChangepassword & !trigerValidPassword)">Пароль должен содержать в себе цифры, буквы латинского алфавита нижнего и верхнего регистра и спец сиволы (!#$%&)</span>
                        <span class="invalid-feedback" v-if="( trigerChangepassword & v$.formUser.password.minLength.$invalid)">Пароль должен быть минимум из 10 символов</span>
                        <span class="invalid-feedback" v-if="(trigerChangepassword & v$.formUser.password.maxLength.$invalid)">Пароль должен быть не больше 50 символов</span>
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" :class="(( trigerChangeemail & v$.formUser.email.$invalid)) ? 'is-invalid' : '' " class="form-label">Почта</label>
                        <input v-model="formUser.email" type="email" class="form-control" id="patronymic">
                        <span class="invalid-feedback" v-if="( trigerChangeemail & v$.formUser.email.required.$invalid)">Поле должно быть заполнено</span>
                        <span class="invalid-feedback" v-if="( trigerChangeemail & v$.formUser.email.email.$invalid)">Должна быть введена электронная почта</span>
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Отделение</label> <br>
                        <select :class="(( trigerChangedepartment & v$.formUser.department.$invalid)) ? 'is-invalid' : '' "  v-model="formUser.department" @change="changeDep()" class="form-select form-control" id="department">
                            <!-- цикл для вывода всех отделений -->
                            <option v-for="(department,index) in departmentData" :value="department.id">{{ department.name }}</option>
                        </select>  
                        <span class="invalid-feedback" v-if="(trigerChangedepartment & v$.formUser.department.required.$invalid)">Должен быть сделан выбор</span>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Должность</label> <br>
                        <select :class="(( trigerChangepost & v$.formUser.post.$invalid)) ? 'is-invalid' : '' " v-model="formUser.post" class="form-select form-control" id="department">
                            <!-- цикл для вывода всех Должностей -->
                            <option v-for="(departmentPart,index) in departmentPartsData" :value="departmentPart.id" >{{ departmentPart.name }}</option>
                        </select>     
                        <span class="invalid-feedback" v-if="(trigerChangepost & v$.formUser.post.required.$invalid)">Должен быть сделан выбор</span>
                    </div>
                    <button v-if=!trigerChange @click.prevent="addUser" type="submit" class="btn btn-primary">Добавить</button>
                    <button v-if=trigerChange @click.prevent="changeUser(idUserChange)" type="submit" class="btn btn-primary">Изменить</button>
                    <button @click.prevent="clearForm()" type="submit" class="btn btn-danger">Очистить форму</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { assertExpressionStatement } from '@babel/types';
    import { useVuelidate } from '@vuelidate/core'
    import {required, minLength, maxLength, email,}  from '@vuelidate/validators'

    export default{
        setup(){
            return{
                v$:useVuelidate()
            }
        }, 
        props:[
            'users',
        ],
        data(){
            return{
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
                trigerChangedepartment:false,
                trigerChangepost:false,
                trigerChangepassword:false,
                trigerChangeemail:false,
                trigerChangename:false,
                trigerChangesurname:false,
                trigerChangesurname:false,
                trigerChangepatronymic:false,
                trigerValidPassword:false,
                index:'',
            }
            
        },
        watch:{
            formUser:{
                deep:true,
                handler(data){
                    if(data.patronymic && !this.trigerChangepatronymic){
                        this.trigerChangepatronymic=true
                    }
                    if(data.surname && !this.trigerChangesurname){
                        this.trigerChangesurname=true
                    }
                    if(data.name && !this.trigerChangename){
                        this.trigerChangename=true
                    }
                    if(data.email && !this.trigerChangeemail){
                        this.trigerChangeemail=true
                    }
                    if(data.password){
                        this.trigerChangepassword=true;

                        this.trigerValidPassword=this.passwordCheck(data.password);
                    }
                    if(data.post && !this.trigerChangepost){
                        this.trigerChangepost=true;

                    }
                    if(data.department && !this.trigerChangedepartment){
                        this.trigerChangedepartment=true;
                        this.getDepartmentParts(); 

                    }
                }
            },
        },  
        methods:{
            changeDep(){
                this.trigerChangedepartment=false;
                this.trigerChangepost=false;
            },  
            changeUserinForm(idUser,index){
                alert('Если вы заполните пароль, то он измениться в БД!');
                this.trigerChange=true;
                this.idUserChange=idUser;
                this.index=index;
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
                });
            },
            //Получение токена
            getToken(){
                axios.post('/admin/token').then((response)=>{
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
                });
            },
            clearForm(){
                this.trigerChange=false,
                this.formUser={
                    patronymic:'',
                    surname:'',
                    name:'',
                    department:'',
                    email:'',
                    password:'',
                    post:'',
                    id:'',
                },
                this.idUserChange='';
                this.file='';
                this.groupUser='';
                this.postsUsers='';
                this.textSearch='';
                this.departmentPartsData=[];
                this.trigerChangedepartment=false;
                this.trigerChangepost=false;
                this.trigerChangepassword=false;
                this.trigerChangeemail=false;
                this.trigerChangename=false;
                this.trigerChangesurname=false;
                this.trigerChangesurname=false;
                this.trigerChangepatronymic=false;
                this.trigerValidPassword=false;
            },
            changeUser(idUser){
                if(this.formCheck()){

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
                        alert('Изменение прошли успешно');
                        this.trigerChange=false;

                        this.usersData[this.index]=response.data;
                        this.clearForm();
                    });
                }
                else{
                    this.trigerChangedepartment=true;
                    this.trigerChangepost=true;
                    this.trigerChangepassword=true;
                    this.trigerChangeemail=true;
                    this.trigerChangename=true;
                    this.trigerChangesurname=true;
                    this.trigerChangesurname=true;
                    this.trigerChangepatronymic=true;
                }
                
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
                            alert('Удаление прошло успешно!');
                            this.usersData.splice(idUser,1)
                        })
                    }
                }
            },
            passwordCheck(value){
                if(this.trigerChange && this.formUser.password==''){
                    return true;
                }
                else{
                    let value1=String(value);
                    var reg=/(?=.*[0-9])(?=.*[!#$%&])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!#$%&]{10,}/g;
                    if(reg.test(value1)){
                        return(true);
                    }else{
                        return(false)
                    }
                }
            },
            formCheck(){
                if(this.trigerValidPassword & !this.v$.formUser.$invalid){
                    return true
                }
                else{
                    if(this.formUser.password=='' && this.trigerChange){
                        return true;
                    }
                    return false    
                }
            },  
            formCheckAdd(){
                if(this.trigerValidPassword & !this.v$.formUser.$invalid){
                    return true
                }
                else{
                    return false    
                }
            },  
            addUser(){
                this.trigerValidPassword=true;
                if(this.formCheckAdd()){
                    let name=this.formUser.surname+" "+this.formUser.name+" "+this.formUser.patronymic;
                    var form=new FormData();
                    form.append('name',name);
                    form.append('email',this.formUser.email);
                    form.append('password',this.formUser.password);
                    form.append('department_part',this.formUser.post);
                    form.append('token',this.token);
                    axios.post('/api/admin/addUser',form).then((response)=>{
                        alert('Добавление прошло успешно!');
                        this.usersData.push(response.data);
                        this.clearForm();
                    });
                }
                else{
                    this.trigerChangedepartment=true;
                    this.trigerChangepost=true;
                    this.trigerChangepassword=true;
                    this.trigerChangeemail=true;
                    this.trigerChangename=true;
                    this.trigerChangesurname=true;
                    this.trigerChangesurname=true;
                    this.trigerChangepatronymic=true;
                }
            },
            importFile(){
                //const config = { 'content-type': 'multipart/file.type' } нз, может нужен, может нет
                if(this.$refs.file!=null){
                    let data=new FormData();
                    data.append('file',this.$refs.file.files[0])
                    axios.post('/api/admin/importUsers',data/*,config*/).then((response)=>{
                        alert('Добавление прошло успешно!');
                        window.location.reload();
                    });
                }
                else{
                    alert("Файл не выбран.");
                }
            },
            exportFile(){
                axios.post('/api/admin/downloadUser', {
                }, {
                    responseType: 'blob'
                }).then((response) => {
                    const url = URL.createObjectURL(new Blob([response.data], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    }))
                    const link = document.createElement('a')
                    link.href = url
                    link.setAttribute('download', 'users')
                    document.body.appendChild(link)
                    link.click()
                });
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
        mounted(){
            this.getToken();
            // axios на запрос всех отделений (id, name) и циклов выводится в select
        },
        validations (){
            return{
                formUser:{
                    patronymic:{
                        required,
                        maxLength: maxLength(82)
                    },
                    surname:{
                        required,
                        maxLength:maxLength(82)
                    },
                    name:{
                        required,
                        maxLength:maxLength(82)
                    },
                    department:{
                        required
                    },
                    email:{
                        required,
                        email
                    },
                    password:{
                        required,
                        minLength:minLength(10),
                        maxLength:maxLength(50),
                        
                    },
                    post:{
                        required
                    },
                },
            }
        },

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