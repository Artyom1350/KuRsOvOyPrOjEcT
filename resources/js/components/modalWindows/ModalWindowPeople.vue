<template>
    <div class="modalWindow">
        <div class="textArea">
            <h2 class='text-center'>Выбор групп пользователей</h2>
            <div class="form-group">
                <label for="searchGroup">Поиск</label>
                <input type="text" class="form-control searchString" name="searchGroup" id="searchGroup" @keyup="getsearchGroup"
                v-model="textSearchGroup">
            </div>
            <div class="grupPeople d-flex flex-wrap">
                <div class="group-unit form-check mr-3" v-for="(group,index) in groups">
                    <input class="form-check-input" type="checkbox" :value="group" :id="'selectGroup'+index" @change="checkArray" v-model='groupSelect'>
                    <label class="form-check-label" :for="'selectGroup'+index">
                        {{ group.name }}
                    </label>
                </div>
            </div>
            <h2 class='text-center mt-2'>Выбор пользователей</h2>
            <div class="form-group">
                <label for="searchPeople">Поиск</label>
                <input type="text" class="form-control searchString" name="searchPeople" id="searchPeople" @keyup="getSearchPeople" v-model="textSearch">
            </div>
            <div class="people d-flex flex-wrap" >
                <div class="people-unit form-check mr-3" v-for="(user, index) in users">
                    <input class="form-check-input" type="checkbox" :value="user" :id="'selectPeople'+index" @change="checkArray" v-model='peopleSelect'>
                    <label class="form-check-label" :for="'selectPeople'+index">
                        {{ user.name }}
                    </label>
                </div>
            </div>
        </div>
        <div class="buttonWrap d-flex align-items-center mt-1">
            <button class="btn btn-primary" :class="(this.windowWidth>1080) ? 'w-25' : 'w-50 mr-2'"  @click="closeModal" :disabled="!disabledButton">Выбрать</button>
            <button class="btn btn-danger"  :class="(this.windowWidth>1080) ? 'w-25' : 'w-50 ml-2'" @click="closeModal">Отмена</button>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                groupSelect:this.groupSelectParrent,
                peopleSelect:this.peopleSelectParrent,
                disabledButton:false,
                users:{},
                groups:{},
                textSearch:'',
                textSearchGroup:'',
                windowWidth: window.innerWidth
            };

        },
        mounted(){
            window.onresize = () => {
                this.windowWidth = window.innerWidth
            }
        },
        props:[
            'groupSelectParrent',
            'peopleSelectParrent',
            'token',
        ],
        methods:{
                closeModal(){
                    this.$emit('close');
                },
                checkArray(){
                    if(this.groupSelect[0]!=null || this.peopleSelect[0]!=null){
                        this.disabledButton=true;
                    }
                    else{
                        this.disabledButton=false;
                    }
                    this.udpadeParrentArray();
                },
                udpadeParrentArray(){
                    this.$emit('udpadeParrentArray', {
                        groupSelectChild: this.groupSelect,
                        peopleSelectChild: this.peopleSelect,
                    })
                },
                getUsers(token){
                    axios.post('/api/myAppl/getUsers',{'token':token}).then((response)=>{
                    this.users=response.data.users;
                    });
                },
                getGroups(token){
                    axios.post('/api/myAppl/getDepartment',{'token':token}).then((response)=>{
                        this.groups=response.data.department;
                    })
                },
                getSearchPeople(){

                    for( var i=0;i< $('.people-unit').length;i++){
                        var el=$('.people-unit')[i];

                        if(el.outerText.includes(this.textSearch)){
                            el.style.display="block"
                        }else{
                            el.style.display="none"

                        }
                    }
                },
                getsearchGroup(){
                    for( var i=0;i< $('.group-unit').length;i++){
                        var el=$('.group-unit')[i];
                        if(el.outerText.includes(this.textSearchGroup)){
                            el.style.display="block"
                        }else{
                            el.style.display="none"
                        }
                    }
                }
            },
            created(){
                this.getUsers(this.$props.token);
                this.getGroups(this.$props.token);
            }
    }
</script>

<style>
    .grupPeople{
        height: 75px;
        overflow-y: scroll;
    }
    .people{
        height: 75px;
        overflow-y: scroll;
    }
    .modalWindow{
        width: calc(100% - 500px);
        height: 500px;
        padding: 20px;
        box-shadow: 1px 1px 3000px black;
        position: absolute;
        margin: auto;
        top: 15%;
        left:0;
        right: 0;
        background: #fff;
    }

    .displayNoneImportant{
        display: none !important;
    }
    @media screen and (max-width:720px) {
        .people {
            height: 20%;
        }
        .grupPeople {
            height: 35%;
        }
    }
</style>
