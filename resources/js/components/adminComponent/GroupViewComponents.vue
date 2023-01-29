<template>
    <div class="wrap">
        <div class="d-flex align-items-start justify-content-between">
            <div class="usersView w-50 mr-2">
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
                </div>
            </div>
            <div class="form_users w-50 ml-2">
                <h3 class="text-center">Форма добавления/изменения</h3>
                <form>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Фамилия</label>
                        <input v-model="formUser.surname" type="text" class="form-control" id="surname">
                    </div>
                    
                    <div class="mb-3">
                        <label for="department" class="form-label">Отделение</label> <br>
                        <select v-model="formUser.department" class="form-select form-control" id="department">
                            <!-- цикл для вывода всех отделений -->
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>                   
                    </div>
                    <button v-if=!trigerChange @click.prevent="" type="submit" class="btn btn-primary">Добавить</button>
                    <button v-if=trigerChange @click.prevent="changeUser()" type="submit" class="btn btn-primary">Изменить</button>
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
                }
            }
            
        },
        methods:{
            changeUserinForm(idUser){
                this.trigerChange=true;
                // axios на доставку одного подразделения(тип name, department_part_id)
                // name.split(' ') и по очерёдно присваиваем к formUser
            },
            changeUser(idUser){
                // axios на изменение
                this.trigerChange=false;
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
            }
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
</style>