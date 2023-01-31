<template>
    <div class="wrap">
        <div class="d-flex align-items-start justify-content-between">
            <div class="usersView w-50 mr-4">
                <h3 class="text-center">Отделения</h3>
                <hr>
                <input type="text" name="searchUsers" id="searchUsers" class="form-control mb-2" placeholder="Поиск пользователей">
                <div class="globalUserWrap">
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения</p>
                            <div class="crud_button h-100 w-50 d-flex align-items-center justify-content-around">
                                <input type="hidden" value="idUser">
                                <button type="submit" @click.prevent="changeUserinForm()" class="btn btn-primary mb-3">Изменить</button>
                                <button type="submit" @click.prevent="removeUser()" class="btn btn-danger mb-3">Удалить</button>
                            </div>
                        </div>
                        <hr class="mt-0">
                    </div>
                    <div class="wrapUser"><!-- Этот элемент в цикл -->
                        <div class="user h-auto d-flex align-items-start justify-content-between">
                            <p class="w-75">Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения Пример большого большого очень большого названия отделения</p>
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
                <h3 class="text-center">Форма добавления/изменения</h3>
                <form>
                    <div class="mb-3">
                        <label for="department" class="form-label">Название отделения</label>
                        <br>
                        <textarea v-model="formGroup.name" class="form-control" id="department"></textarea>
                    </div>
                    <button v-if=!trigerChange @click.prevent="addUser" type="submit" class="btn btn-primary">Добавить</button>
                    <button v-if=trigerChange @click.prevent="changeUser(idGroup)" type="submit" class="btn btn-primary">Изменить</button>
                </form>
            </div>
            
        </div>
    </div>
</template>
<script>
    export default{
        props:[
            'groupInfo',
        ],
        data(){
            return{
                //name, id. Использовать в цикле на wrapUser
                usersData:this.$props.groupInfo,
                trigerChange:false,
                formGroup:{
                    name:'',
                },
                idGroup:"",
            }
            
        },
        methods:{
            changeUserinForm(idUser){
                this.trigerChange=true;
                this.idGroup=idUser
                // axios на доставку одного подразделения(тип name, department_part_id)
                // name.split(' ') и по очерёдно присваиваем к formGroup
            },
            changeUser(idUser){
                // axios на изменение
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
            addUser(){
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
.globalUserWrap{
    overflow-y: scroll auto;
	height: 315px;
}
.addition{
    padding: 0;
    height: 32px;
}
</style>