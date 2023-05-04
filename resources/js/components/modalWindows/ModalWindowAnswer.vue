<template>
    <div class="modalWindow">
        <div class="textArea h-90">
            <h2 class='text-center mt-3'>Статусы пользователей</h2>
            <div class="form-group" style="height: 85%;">
                <label for="searchPeople">Поиск</label>
                <input type="text" class="form-control searchString" name="searchPeople" id="searchPeople" @keyup="getSearchPeople" v-model="textSearch">
                <div class="table-wrap">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Пользователь</th>
                                <th scope="col">Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users" class="people-unit">
                                <td>{{ index+1 }}</td>
                                <td>{{ user.name }}</td>
                                <td :class="getColor(user.status)">{{ statusAppl[user.status] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="buttonWrap d-flex align-items-center">
            <button class="btn btn-danger w-25 " @click="closeModal">Закрыть</button>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                users:[],
                textSearch:'',
                statusAppl:[
                    'Не прочитано',
                    'Прочитано',
                    'В работе',
                    'Готово',
                ],
            };

        },
        mounted(){
            this.getUsers();
        },
        props:[
            'idDocuments',
            'token'
        ],
        methods:{
                closeModal(){
                    this.$emit('close');
                },
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
                getUsers(){
                    this.showLoader();
                    axios.post('/api/myAppl/getAnswersUsers',{'id_doc':this.$props.idDocuments,'token':this.$props.token}).then((response)=>{
                        this.users=response.data.users;
                        this.hideLoader();
                    });
                },
                getColor(id){
                    if(id==0){
                        return "text-danger";
                    }
                    if(id==1){
                        return "text-muted";
                    }
                    if(id==2){
                        return "text-primary";
                    }
                    if(id==3){
                        return "text-success";
                    }
                    else{
                        return " ";
                    }
                },
                getSearchPeople(){
                    for( var i=0;i< $('.people-unit').length;i++){
                        var el=$('.people-unit')[i];

                        if(el.outerText.includes(this.textSearch)){
                            el.style.display="table-row"
                        }else{
                            el.style.display="none"
                        }
                    }
                },
            },

    }
</script>

<style>

    .modalWindow{
        width: calc(100% - 600px);
        height: 500px;
        padding: 20px;
        box-shadow: 1px 1px 3000px black;
        position: absolute;
        margin: auto;
        top: 30%;
        left:0;
        right: 0;
        background: #fff;
        border-radius: 15px;
    }

    .displayNoneImportant{
        display: none !important;
    }

    .textArea{
        height: 90%;
    }
    .table-wrap{
        height: 300px;
        overflow-y: scroll ;
    }
    .people{
        overflow-y: scroll;
    }

    @media screen and (max-width:720px) {

    }
    @media screen and (max-width:1080px) {
        .modalWindow{
            width: 100% !important;
            top: 0 !important;
            height: 100% !important;
        }
    }
</style>
