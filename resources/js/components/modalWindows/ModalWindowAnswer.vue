<template>
    <div class="modalWindow">
        <div class="textArea h-90">
            <h2 class='text-center mt-5'>Выбор пользователей</h2>
            <div class="form-group" style="height: 85%;">
                <label for="searchPeople">Поиск</label>
                <input type="text" class="form-control searchString" name="searchPeople" id="searchPeople" @keyup="getSearchPeople" v-model="textSearch">
                <div class="people d-flex flex-wrap mt-2" >
                    <div class="people-unit w-100 h-10" v-for="(user, index) in users">
                        <div class="form-check mr-3 d-flex justify-content-around w-100" >
                            <p class="m-1"><b>Пользователь:</b> {{ user.name }}</p>
                            <p class="m-1"><b>Статус:</b> {{ user.status }}</p>
                        </div>
                    </div>
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
            };
            
        },
        mounted(){
            
        },
        props:[
            'idDocuments'
        ],
        methods:{
                closeModal(){
                    this.$emit('close');
                },
                getUsers(){
                    axios.post('/getAnswersUsers',{'id_doc':this.$props.idDocuments}).then((response)=>{
                        console.log(this.$props.idDocuments);
                        console.log(response);
                         this.users=response.data.users;
                         console.log(this.users.data);
                    })
                },
                getSearchPeople(){
                    for( var i=0;i< $('.people-unit').length;i++){
                        var el=$('.people-unit')[i];
                        
                        if(el.outerText.includes(this.textSearch)){
                            console.log(el.outerText);
                            el.style.display="block"
                        }else{
                            el.style.display="none"
                            
                        }
                    }
                },
            },
            created(){
                this.getUsers();
            }
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
        margin-top: -45px;
    }

    .people{
        overflow-y: scroll;
        height: 80%;
    }
</style>