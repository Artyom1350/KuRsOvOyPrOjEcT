<template>
    <div>
        <div class="mb-2 mt-2">
            <input type="text" class="form-control searchString" placeholder="Поиск заявок" name="search" @keyup="getsearchInput"
            v-model="textSearchInput">
        </div>
        <div v-for="(applicat,index) in mydata">
            <div  class="wrap-cardInput " :class="(index<countPagination)?'':'d-noneInput'">
                <div class="h-auto application d-flex justify-content-between" :id="'appl'+index" :key="index">
                    <p class="ml-3 mr-3" ><b>{{applicat.name}}</b></p>
                    <div class="mr-3 h-auto text-wrap d-flex justify-content-between">
                        <a @click="dowloadDocument(applicat.id)">    
                            <button class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                            </button>
                        </a>
                        <a :href="'/myAppl/changeApplication/'+applicat.id"  v-if="applicat.visible">
                            <button class=" btn ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </a>
                        <a :href="'#appl'+ index ">
                            <button @click="openModalWind(applicat.id)" class=" btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="makeAppl d-block ml-auto mt-3">
            <input v-if="!trigerPagin && trigerGlobalPagin" class="btn btn-primary " type="button" value="Показать ещё" @click="pagination">
            <input v-if="trigerPagin && trigerGlobalPagin" class="btn btn-primary " type="button" value="Скрыть всё" @click="notPagination">
        </div>
        <ModalWindowAnsw v-if="trigerModal" @close="trigerModal=false" :idDocuments="idDocumentOpen" :token="$props.token"></ModalWindowAnsw>
    </div>
</template>

<script>
    import ModalWindowAnsw from '../modalWindows/ModalWindowAnswer.vue';

    export default {
        props: ['mydata','token',],
        data(){
            return{
                trigerModal:false,
                idDocumentOpen:0,
                textSearchInput:'',
                countPagination: 3,
                trigerPagin:false,
                trigerGlobalPagin:false
            };
        },methods:{
            openModalWind(idDocument){
                this.idDocumentOpen=idDocument;
                this.trigerModal=true;
            },
            dowloadDocument(id){    
                let headers={
                    responseType:'blob'
                }
                axios.post('/api/myAppl/Download',{'id':id,'token':this.$props.token},headers).then((res)=>{
                    if(res.headers['filename']){
                        const blob = new Blob([res.data], { type: res.headers['content-type'] })
                        console.log(res.headers)
                        const downloadUrl = window.URL.createObjectURL(blob)
                        const linkUrl = document.createElement('a')
                        linkUrl.download = res.headers['filename']
                        linkUrl.href = downloadUrl
                        document.body.appendChild(linkUrl)
                        linkUrl.click()
                        document.body.removeChild(linkUrl)
                        linkUrl.remove()
                    }
                    else{
                        alert('Файл не найден!');
                    }
                })
            },
            getsearchInput(){
                console.log( this.textSearchInput.length);
                if( this.textSearchInput.length == 0){

                    this.countPagination=3;
                }
                else this.countPagination=999999999999999;
                for( var i=0;i< $('.wrap-cardInput').length;i++){
                    var el=$('.wrap-cardInput')[i];

                    if(el.outerText.includes(this.textSearchInput)){

                        el.style.display="block"
                    }else{
                        el.style.display="none"
                    }
                }
            },
            visible(){
                return false;
            },
            pagination(){
                this.countPagination+=3;
                if(this.countPagination>=this.mydata.length){
                    this.trigerPagin=true;
                }
            },
            notPagination(){
                this.countPagination=3;
                this.trigerPagin=false;
            },
            checkPagin(){
                if(this.countPagination<this.mydata.length){
                    this.trigerGlobalPagin=true;
                }
            }
        },
        components:{
            ModalWindowAnsw
        },
        mounted(){
            this.checkPagin();
        }
    }
</script>

<style>
.searchString{
border-radius: 15px;
}
.d-noneInput{
    display: none !important;
}
</style>
