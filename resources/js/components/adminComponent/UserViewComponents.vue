<template>
    <div class="wrap">
        <div
            class="d-flex align-items-start justify-content-between"
            :class="{
                'flex-column': windowWidth <= 720,
            }"
        >
            <div
                class="usersView"
                :class="{
                    'w-50': windowWidth > 720,
                    'mr-4': windowWidth > 1080,
                    'mr-2': windowWidth <= 1080 && windowWidth > 720,
                }"
            >
                <h3 class="mt-3 text-center"><b>Пользователи</b></h3>
                <hr />
                <input
                    type="text"
                    name="searchUsers"
                    id="searchUsers"
                    class="form-control mb-2"
                    placeholder="Поиск пользователей"
                    @keyup="getSearchPeople()"
                    v-model="textSearch"
                />
                <div class="globalUserWrap">
                    <div class="wrapUser" v-for="(user, index) in usersData">
                        <div
                            class="user d-flex align-items-start justify-content-between"
                        >
                            <p class="w-75">{{ user.name }}</p>
                            <div
                                class="crud_button h-100 d-flex align-items-start justify-content-around"
                                :class="windowWidth > 1080 ? 'w-50' : 'w-25'"
                            >
                                <input type="hidden" value="idUser" />
                                <button
                                    v-if="windowWidth <= 1080"
                                    type="submit"
                                    @click.prevent="
                                        changeUserinForm(user.id, index)
                                    "
                                    class="btn mb-3"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-pencil-square"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                                        />
                                    </svg>
                                </button>
                                <button
                                    v-if="windowWidth <= 1080"
                                    type="submit"
                                    @click.prevent="removeUser(index)"
                                    class="btn mb-3"
                                >
                                    <svg
                                        fill="currentColor"
                                        class="bi bi-trash3"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"
                                        />
                                    </svg>
                                </button>
                                <button
                                    v-if="windowWidth > 1080"
                                    type="submit"
                                    @click.prevent="
                                        changeUserinForm(user.id, index)
                                    "
                                    class="btn btn-primary mb-3"
                                >
                                    Изменить
                                </button>
                                <button
                                    v-if="windowWidth > 1080"
                                    type="submit"
                                    @click.prevent="removeUser(index)"
                                    class="btn btn-danger btn-danger-users mb-3"
                                >
                                    Удалить
                                </button>
                            </div>
                        </div>
                        <hr class="mt-0" />
                    </div>
                </div>
                <div
                    class="mt-3 buttonImportExp d-flex align-items-end justify-content-between"
                    :class="
                        windowWidth <= 1080 && windowWidth > 720
                            ? 'flex-wrap'
                            : ''
                    "
                >
                    <div class="mb-3 fileImport">
                        <label for="formFile" class="form-label"
                            >Выберите файл для импорта</label
                        >
                        <input
                            class="form-control field addition"
                            name="file"
                            ref="file"
                            type="file"
                            id="formFile"
                            @change="changeMessage()"
                        />
                    </div>
                    <button
                        v-if="windowWidth <= 720"
                        type="submit"
                        @click.prevent="importFile()"
                        class="btn btn-primary btn-adaptiv-import mb-3"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            fill="currentColor"
                            class="bi bi-arrow-bar-down"
                            viewBox="0 0 16 16"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"
                            />
                        </svg>
                    </button>
                    <button
                        v-if="windowWidth <= 720"
                        type="submit"
                        @click.prevent="exportFile()"
                        class="btn btn-primary btn-adaptiv-export mb-3"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            fill="currentColor"
                            class="bi bi-arrow-bar-up"
                            viewBox="0 0 16 16"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"
                            />
                        </svg>
                    </button>
                    <button
                        v-if="windowWidth > 720"
                        type="submit"
                        @click.prevent="importFile()"
                        class="btn btn-primary btn-import mb-3"
                    >
                        Импорт
                    </button>
                    <button
                        v-if="windowWidth > 720"
                        type="submit"
                        @click.prevent="exportFile()"
                        class="btn btn-primary btn-export mb-3"
                    >
                        Экспорт
                    </button>
                </div>
            </div>
            <div
                class="form_users"
                :class="{
                    'w-50': windowWidth > 720,
                    'ml-5': windowWidth > 1080,
                    'ml-2': windowWidth <= 1080 && windowWidth > 720,
                }"
            >
                <h3 v-if="!trigerChange" class="mt-3 text-center">
                    <b>Форма добавления</b>
                </h3>
                <h3 v-if="trigerChange" class="mt-3 text-center">
                    <b>Форма изменения</b>
                </h3>
                <form>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Фамилия</label>
                        <input
                            v-model="formUser.surname"
                            type="text"
                            class="form-control"
                            :class="
                                trigerChangesurname &
                                v$.formUser.surname.$invalid
                                    ? 'is-invalid'
                                    : ''
                            "
                            id="surname"
                        />
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangesurname &
                                v$.formUser.surname.required.$invalid
                            "
                            >Поле должно быть заполнено</span
                        >
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangesurname &
                                v$.formUser.surname.maxLength.$invalid
                            "
                            >Максимальное количество символов 82</span
                        >
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input
                            v-model="formUser.name"
                            type="text"
                            class="form-control"
                            :class="
                                trigerChangename & v$.formUser.name.$invalid
                                    ? 'is-invalid'
                                    : ''
                            "
                            id="name"
                        />
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangename &
                                v$.formUser.name.required.$invalid
                            "
                            >Поле должно быть заполнено</span
                        >
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangename &
                                v$.formUser.name.maxLength.$invalid
                            "
                            >Максимальное количество символов 82</span
                        >
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" class="form-label"
                            >Отчество</label
                        >
                        <input
                            v-model="formUser.patronymic"
                            type="text"
                            class="form-control"
                            :class="
                                trigerChangepatronymic &
                                v$.formUser.patronymic.$invalid
                                    ? 'is-invalid'
                                    : ''
                            "
                            id="patronymic"
                        />
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangepatronymic &
                                v$.formUser.patronymic.required.$invalid
                            "
                            >Поле должно быть заполнено</span
                        >
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangepatronymic &
                                v$.formUser.patronymic.maxLength.$invalid
                            "
                            >Максимальное количество символов 82</span
                        >
                    </div>
                    <div class="mb-3">
                        <label
                            for="patronymic"
                            :class="
                                trigerChangepassword &
                                    v$.formUser.password.$invalid ||
                                trigerChangepassword & !trigerValidPassword
                                    ? 'is-invalid'
                                    : ''
                            "
                            class="form-label"
                            >Пароль</label
                        >
                        <input
                            v-model="formUser.password"
                            type="text"
                            class="form-control"
                            id="patronymic"
                        />
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangepassword &
                                v$.formUser.password.required.$invalid
                            "
                            >Поле должно быть заполнено</span
                        >
                        <span
                            class="invalid-feedback"
                            v-if="trigerChangepassword & !trigerValidPassword"
                            >Пароль должен содержать в себе цифры, буквы
                            латинского алфавита нижнего и верхнего регистра и
                            спец сиволы (!#$%&)</span
                        >
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangepassword &
                                v$.formUser.password.minLength.$invalid
                            "
                            >Пароль должен быть минимум из 10 символов</span
                        >
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangepassword &
                                v$.formUser.password.maxLength.$invalid
                            "
                            >Пароль должен быть не больше 50 символов</span
                        >
                    </div>
                    <div class="mb-3">
                        <label
                            for="patronymic"
                            :class="
                                trigerChangeemail & v$.formUser.email.$invalid
                                    ? 'is-invalid'
                                    : ''
                            "
                            class="form-label"
                            >Почта</label
                        >
                        <input
                            v-model="formUser.email"
                            type="email"
                            class="form-control"
                            id="patronymic"
                        />
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangeemail &
                                v$.formUser.email.required.$invalid
                            "
                            >Поле должно быть заполнено</span
                        >
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangeemail &
                                v$.formUser.email.email.$invalid
                            "
                            >Должна быть введена электронная почта</span
                        >
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label"
                            >Отделение</label
                        >
                        <br />
                        <select
                            :class="
                                trigerChangedepartment &
                                v$.formUser.department.$invalid
                                    ? 'is-invalid'
                                    : ''
                            "
                            v-model="formUser.department"
                            @change="changeDep()"
                            class="form-select form-control"
                            id="department"
                        >
                            <!-- цикл для вывода всех отделений -->
                            <option
                                v-for="(department, index) in departmentData"
                                :value="department.id"
                            >
                                {{ department.name }}
                            </option>
                        </select>
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangedepartment &
                                v$.formUser.department.required.$invalid
                            "
                            >Должен быть сделан выбор</span
                        >
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label"
                            >Должность</label
                        >
                        <br />
                        <select
                            :class="
                                trigerChangepost & v$.formUser.post.$invalid
                                    ? 'is-invalid'
                                    : ''
                            "
                            v-model="formUser.post"
                            class="form-select form-control"
                            id="department"
                        >
                            <!-- цикл для вывода всех Должностей -->
                            <option
                                v-for="(
                                    departmentPart, index
                                ) in departmentPartsData"
                                :value="departmentPart.id"
                            >
                                {{ departmentPart.name }}
                            </option>
                        </select>
                        <span
                            class="invalid-feedback"
                            v-if="
                                trigerChangepost &
                                v$.formUser.post.required.$invalid
                            "
                            >Должен быть сделан выбор</span
                        >
                    </div>
                    <button
                        v-if="!trigerChange"
                        @click.prevent="addUser"
                        type="submit"
                        class="btn btn-primary btn-primary-users"
                    >
                        Добавить
                    </button>
                    <button
                        v-if="trigerChange"
                        @click.prevent="changeUser(idUserChange)"
                        type="submit"
                        class="btn btn-primary"
                    >
                        Изменить
                    </button>
                    <button
                        @click.prevent="clearForm()"
                        type="submit"
                        class="btn btn-danger btn-danger-users"
                    >
                        Очистить форму
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { assertExpressionStatement } from "@babel/types";
import { useVuelidate } from "@vuelidate/core";
import { required, minLength, maxLength, email } from "@vuelidate/validators";
import swal from "sweetalert";

export default {
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    props: ["users", "token"],
    data() {
        return {
            usersData: this.$props.users,
            trigerChange: false,
            formUser: {
                patronymic: "",
                surname: "",
                name: "",
                department: "",
                email: "",
                password: "",
                post: "",
                id: "",
            },
            idUserChange: "",
            file: "",
            groupUser: "",
            postsUsers: "",
            textSearch: "",
            departmentData: [],
            departmentPartsData: [],
            trigerChangedepartment: false,
            trigerChangepost: false,
            trigerChangepassword: false,
            trigerChangeemail: false,
            trigerChangename: false,
            trigerChangesurname: false,
            trigerChangesurname: false,
            trigerChangepatronymic: false,
            trigerValidPassword: false,
            index: "",
            windowWidth: window.innerWidth,
        };
    },
    watch: {
        formUser: {
            deep: true,
            handler(data) {
                if (data.patronymic && !this.trigerChangepatronymic) {
                    this.trigerChangepatronymic = true;
                }
                if (data.surname && !this.trigerChangesurname) {
                    this.trigerChangesurname = true;
                }
                if (data.name && !this.trigerChangename) {
                    this.trigerChangename = true;
                }
                if (data.email && !this.trigerChangeemail) {
                    this.trigerChangeemail = true;
                }
                if (data.password) {
                    this.trigerChangepassword = true;

                    this.trigerValidPassword = this.passwordCheck(
                        data.password
                    );
                }
                if (data.post && !this.trigerChangepost) {
                    this.trigerChangepost = true;
                }
                if (data.department && !this.trigerChangedepartment) {
                    this.trigerChangedepartment = true;
                    this.getDepartmentParts();
                }
            },
        },
    },
    methods: {
        showLoader(){
                let loaderFind=document.getElementById('loader-test');
                
                loaderFind.style.opacity=100;
                loaderFind.style.top=0;
        },
        hideLoader(){
            let loaderFind=document.getElementById('loader-test');

            loaderFind.style.opacity=0;
            loaderFind.style.top='-100%';
        },
        changeDep() {
            this.trigerChangedepartment = false;
            this.trigerChangepost = false;
        },
        /** Получение пользователя на редактирование */
        changeUserinForm(idUser, index) {
            swal(
                "Если вы заполните пароль, то он измениться в БД!",
                "",
                "warning"
            ).then((val) => {
                this.trigerChange = true;
                this.idUserChange = idUser;
                this.index = index;
                //var form=new FormData();
                //form.append('id',this.idUserChange);
                //form.append('token',this.token);

                let form = {
                    id: this.idUserChange,
                    token: this.$props.token,
                };
                axios.post("/api/admin/getOneUser", form).then((response) => {
                    this.formUser.surname =
                        response.data.user.name.split(" ")[0];
                    this.formUser.name = response.data.user.name.split(" ")[1];
                    this.formUser.patronymic =
                        response.data.user.name.split(" ")[2];
                    this.formUser.id = response.data.user.id;
                    this.formUser.email = response.data.user.email;
                    //this.formUser.password=response.data.user.password; пароль нельзя дехешировать так что да
                    this.formUser.post = response.data.user.department_part_id;
                    this.formUser.department = response.data.department;
                    this.getDepartmentParts();
                });
            });
        },
        //все департменты
        getDepartment() {
            axios
                .post("/api/admin/getAllDepartments", {
                    token: this.$props.token,
                })
                .then((response) => {
                    this.departmentData = response.data.departments;
                });
        },
        //должности
        getDepartmentParts() {
            axios
                .post("/api/admin/getDepartmentParts", {
                    token: this.$props.token,
                    id: this.formUser.department,
                })
                .then((response) => {
                    this.departmentPartsData = response.data.departmentParts;
                });
        },
        clearForm() {
            (this.trigerChange = false),
                (this.formUser = {
                    patronymic: "",
                    surname: "",
                    name: "",
                    department: "",
                    email: "",
                    password: "",
                    post: "",
                    id: "",
                }),
                (this.idUserChange = "");
            this.file = "";
            this.groupUser = "";
            this.postsUsers = "";
            this.textSearch = "";
            this.departmentPartsData = [];
            this.trigerChangedepartment = false;
            this.trigerChangepost = false;
            this.trigerChangepassword = false;
            this.trigerChangeemail = false;
            this.trigerChangename = false;
            this.trigerChangesurname = false;
            this.trigerChangesurname = false;
            this.trigerChangepatronymic = false;
            this.trigerValidPassword = false;
        },
        /** запрос на изменение пользователя */
        changeUser(idUser) {
            if (this.formCheck()) {
                this.showLoader();
                let name =
                    this.formUser.surname +
                    " " +
                    this.formUser.name +
                    " " +
                    this.formUser.patronymic;
                let form = {
                    name: name,
                    email: this.formUser.email,
                    password: this.formUser.password,
                    department_part: this.formUser.post,
                    id: this.formUser.id,
                    token: this.$props.token,
                };

                axios.post("/api/admin/changeUser", form).then((response) => {
                    this.hideLoader();
                    swal("Изменение прошли успешно", "", "success");
                    this.trigerChange = false;
                    this.usersData[this.index] = response.data;
                    this.clearForm();
                });
            } else {
                this.trigerChangedepartment = true;
                this.trigerChangepost = true;
                this.trigerChangepassword = true;
                this.trigerChangeemail = true;
                this.trigerChangename = true;
                this.trigerChangesurname = true;
                this.trigerChangesurname = true;
                this.trigerChangepatronymic = true;
            }
        },
        removeUser(idUser) {
            swal(
                "Точно хотите удалить пользователя " +
                    this.usersData[idUser].name,
                "",
                "warning",
                {
                    buttons: {
                        sucsess: {
                            text: "Да",
                            value: true,
                        },
                        def: {
                            text: "Нет",
                            value: false,
                        },
                    },
                }
            ).then((answer) => {
                if (answer) {
                        this.showLoader();
                        axios
                            .post("/api/admin/destroyUser", {
                                id: this.usersData[idUser].id,
                                token: this.$props.token,
                            })
                            .then((response) => {
                                this.hideLoader();
                                swal("Удаление прошло успешно!", "", "success");
                                this.usersData.splice(idUser, 1);
                            });
                }
            });
        },
        passwordCheck(value) {
            if (this.trigerChange && this.formUser.password == "") {
                return true;
            } else {
                let value1 = String(value);
                var reg =
                    /(?=.*[0-9])(?=.*[!#$%&])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!#$%&]{10,}/g;
                if (reg.test(value1)) {
                    return true;
                } else {
                    return false;
                }
            }
        },
        formCheck() {
            if (this.trigerValidPassword & !this.v$.formUser.$invalid) {
                return true;
            } else {
                if (this.formUser.password == "" && this.trigerChange) {
                    return true;
                }
                return false;
            }
        },
        formCheckAdd() {
            if (this.trigerValidPassword & !this.v$.formUser.$invalid) {
                return true;
            } else {
                return false;
            }
        },
        addUser() {
            this.trigerValidPassword = true;
            if (this.formCheckAdd()) {
                this.showLoader();
                let name =
                    this.formUser.surname +
                    " " +
                    this.formUser.name +
                    " " +
                    this.formUser.patronymic;
                let form = {
                    name: name,
                    email: this.formUser.email,
                    password: this.formUser.password,
                    department_part: this.formUser.post,
                    token: this.$props.token,
                };

                axios.post("/api/admin/addUser", form).then((response) => {
                    this.hideLoader();
                    swal("Добавление прошло успешно!", "", "success");
                    this.usersData.push(response.data);
                    this.clearForm();
                });
            } else {
                this.trigerChangedepartment = true;
                this.trigerChangepost = true;
                this.trigerChangepassword = true;
                this.trigerChangeemail = true;
                this.trigerChangename = true;
                this.trigerChangesurname = true;
                this.trigerChangesurname = true;
                this.trigerChangepatronymic = true;
            }
        },
        getTable(array) {
            let main = document.createElement("table");
            let tHead = document.createElement("thead");
            let tBody = document.createElement("tbody");
            //заголовок
            let tr = document.createElement("tr");
            let titleTable = ["Строка", "Описание ошибки"];
            for (let i = 0; i < 2; i++) {
                let td = document.createElement("th");
                td.innerHTML = titleTable[i];
                tr.appendChild(td);
            }
            tr.classList.add('rowHead');
            tHead.appendChild(tr);

            //тело

            for (let j = 0; j < array.length; j++) {
                let tr1 = document.createElement("tr");
                tr1.classList.add('d-flex');
                tr1.classList.add('w-100');
                for (let i = 0; i < array[j].length; i++) {
                    let td = document.createElement("td");
                    td.innerHTML = array[j][i];
                    tr1.appendChild(td);
                    if(i==1){
                        td.classList.add('text-left');
                    }
                }
                tBody.appendChild(tr1);
            }
            tBody.classList.add('scrollY');
            tHead.classList.add('stickyHead');
            main.appendChild(tHead);
            main.appendChild(tBody);
            main.classList.add("table");
            main.classList.add('d-block');
            main.classList.add('w-100');   
            main.classList.add("table-striped");
            return main;
        },
        importFile() {
            
            var trigerError = false;
            if (this.$refs.file.files[0] != null) {
                this.showLoader();
                let data = new FormData();
                data.append("file", this.$refs.file.files[0]);
                data.append("token", this.$props.token);
                axios.post("/api/admin/importUsers", data).then((response) => {
                    this.hideLoader();
                    if (
                        response.data[0] != undefined &&
                        response.data[0] != null &&
                        response.data[0].length != 0
                    ) {
                        trigerError = true;
                        swal({
                            title: "Ошибка структуры файла.",
                            text: "Возможно вы загрузили файл не .xslx формата.",
                            className: "informationError",
                        });
                    }
                    if (
                        response.data[1] != undefined &&
                        response.data[1] != null &&
                        response.data[1].length != 0
                    ) {
                        trigerError = true;
                        swal({
                            title: "Ошибки при импорте пользователей.",
                            content: this.getTable(response.data[1]),
                            className: "informationError",
                        });
                    }
                    if (!trigerError) {
                        swal("Добавление прошло успешно!", "", "success").then(
                            setInterval(function () {
                                window.location.reload();
                            }, 2000)
                        );
                    }
                });
            } else {
                swal("Файл не выбран.", "", "warning");
            }
        },
        exportFile() {
            axios
                .post(
                    "/api/admin/downloadUser",
                    { token: this.$props.token },
                    {
                        responseType: "blob",
                    }
                )
                .then((response) => {
                    const url = URL.createObjectURL(
                        new Blob([response.data], {
                            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        })
                    );
                    const link = document.createElement("a");
                    link.href = url;
                    link.setAttribute("download", "Пользователи");
                    document.body.appendChild(link);
                    link.click();
                });
        },
        changeMessage() {
            if (this.$refs.file != null) {
                this.file = this.$refs.file.files[0];
                let countFiles = "";
                if (this.file) countFiles = this.file.name;
                if (countFiles) {
                } else swal("Файл не выбран.", "", "warning");
            } else {
                this.$refs.file = $(".field")[0];
                this.$refs.file.files = null;
                this.changeMessage();
            }
        },
        getSearchPeople() {
            for (var i = 0; i < $(".user").length; i++) {
                var el = $(".user")[i];
                if (el.outerText.includes(this.textSearch)) {
                    el.parentElement.style.display = "block";
                } else {
                    el.parentElement.style.display = "none";
                }
            }
        },
    },
    mounted() {
        // axios на запрос всех отделений (id, name) и циклов выводится в select
        window.onresize = () => {
            this.windowWidth = window.innerWidth;
        };
    },
    validations() {
        return {
            formUser: {
                patronymic: {
                    required,
                    maxLength: maxLength(82),
                },
                surname: {
                    required,
                    maxLength: maxLength(82),
                },
                name: {
                    required,
                    maxLength: maxLength(82),
                },
                department: {
                    required,
                },
                email: {
                    required,
                    email,
                },
                password: {
                    required,
                    minLength: minLength(10),
                    maxLength: maxLength(50),
                },
                post: {
                    required,
                },
            },
        };
    },
    mounted() {
        this.getDepartment();
    },
};
</script>
<style>
.user {
    height: auto;
}
.globalUserWrap {
    overflow-y: scroll;
    height: 315px;
}
.addition {
    padding: 0;
    height: 32px;
}
.bi-trash3 {
    width: 16px;
}
.usersView {
    width: 100%;
}
.form_users {
    width: 100%;
}
.scrollY{
    display: block;
    height: 300px;
    overflow-y: scroll;
}
.scrollY>tr>td:first-child{
    display: block;
    width: 15%;
}
.scrollY>tr>td:last-child{
    display: block;
    width: 85%;
}

.stickyHead{
    display: block;
    width: 100%;
}
.rowHead{
    width: 100%;
    display: flex;
}
.rowHead :first-child{
    width: 15%;
}
.rowHead :last-child{
    width: 85%;
    /* text-align: left; */
}

@media screen and (min-width: 1080px) {
    .fileImport {
        width: 60%;
    }
}
@media screen and (max-width: 720px) {
    .addition {
        height: 36.5px;
        border-radius: 0.25rem 0 0 0.25rem;
        width: 100%;
    }
    .buttonImportExp > div {
        width: 100%;
    }
    .btn-adaptiv-import {
        border-radius: 0;
    }
    .btn-adaptiv-export {
        border-radius: 0 0.25rem 0.25rem 0;
    }
    form button {
        margin-bottom: 10px;
    }
}
@media screen and (max-width: 1080px) {
    .buttonImportExp .btn {
        width: 50%;
    }
    .buttonImportExp > div {
        width: 100%;
    }
    .btn-import {
        border-radius: 0.25rem 0 0 0.25rem;
    }
    .btn-export {
        border-radius: 0 0.25rem 0.25rem 0;
    }
    form .btn-primary-users {
        width: 43%;
    }
    form .btn-danger-users {
        width: 56%;
    }
}
@media screen and (max-width: 992px) {
    form .btn-primary-users {
        width: 100%;
    }
    form .btn-danger-users {
        width: 100%;
    }
}
</style>
