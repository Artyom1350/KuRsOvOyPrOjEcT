<template>
    <div class="wrap">
        <div class="d-flex align-items-start justify-content-between">
            <div class="usersView w-50 mr-4">
                <h3 class="mt-3 text-center">Пользователи</h3>
                <hr>
                <input type="text" name="searchUsers" id="searchUsers" class="form-control mb-2" placeholder="Поиск пользователей">
                <div class="globalUserWrap">
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример пользователя</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-start justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
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
                        <label for="department" class="form-label">Отделение</label> <br>
                        <select v-model="formUser.department" class="form-select form-control" id="department">
                            <!-- цикл для вывода всех отделений -->
                            <option value="1">One</option>
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
    export default{
        props:[
            'userInfo',
        ],
        data(){
            return{
                //name, id. Использовать в цикле на wrapUser
                usersData:this.$props.userInfo,
                trigerChange:false,
                formUser:{
                    patronymic:'',
                    surname:'',
                    name:'',
                    department:'',
                },
                idUserChange:'',
                file:''
            }
            
        },
        methods:{
            changeUserinForm(idUser){
                this.trigerChange=true;
                idUserChange=idUser;

                // axios на доставку одного пользователя(тип name, department_part_id)
                // name.split(' ') и по очерёдно присваиваем к formUser
            },
            changeUser(idUser){
                this.trigerChange=false;
                // axios на изменение
            },
            removeUser(idUser){
                let answer=confirm('Точно хотите удалить пользователя'
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
            addUser(){
                let FIO=this.formUser.surname+" "+this.formUser.name+" "+this.formUser.patronymic;

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