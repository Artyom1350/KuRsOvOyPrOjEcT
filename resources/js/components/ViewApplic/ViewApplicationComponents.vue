<template>
    <div class="wrap">

    <form class="d-block w-75 m-auto" enctype="multipart/form-data">
        <!--     -->
        <div class="mb-3">
            <label for="nameApplicate" class="form-label">Название:</label>
            <input  type="text" class="form-control" readonly id="nameApplicate" name="nameAppl" placeholder="Название" v-model="nameAppl">
        </div>
        <!-- описание -->
        <div class="mb-3">
            <label for="descripApplicate" class="form-label">Описание:</label>
            <textarea class="form-control" name="descripAppl" readonly id="descripApplicate" rows="3" placeholder="Описание" v-model="descriptionAppl"></textarea>
        </div>
        <!-- дата -->
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Срок выполнения до:</label>
            <input type="date" class="form-control" id="dateApplicate" readonly name="dateAppl" placeholder="Дата" v-model="dateAppl">
        </div>
        <div class="mb-3 d-flex">
            <!-- <a :href="'/myAppl/Download/'+this.$props.applic.doc_id" class="mr-3"><input type="button" class="btn btn-primary btn-download" value="Скачать файл"/></a> -->
            <input type="button" class="mr-3 btn btn-primary btn-download" value="Скачать файл" @click="download()" />
        </div>
        
        <div class="mb-3">
            <label class="mr-1 mt-auto mb-auto" for="statusApplSelect">Статус: </label>
            <select :disabled="visibleStatus" id="statusApplSelect" class="form-select" v-model="statusApplSelect">
                <option v-for="(stat, index) in statusAppl" :value="index">{{stat}}</option>
            </select>
        </div>
    </form>
</div>

</template>

<script>
import { assertExpressionStatement } from '@babel/types';
import swal from 'sweetalert';

    export default {
        props:[
            "applic",
            'token'
        ],
        data(){
            return{
                testDate:new Date(),
                visibleStatus:false,
                nameAppl:this.$props.applic.title,
                descriptionAppl:this.$props.applic.description,
                dateAppl:this.$props.applic.dateAppl,
                peopleSelect:[],
                groupSelect:[],
                file:this.$props.applic.fileName,
                statusAppl:[
                    'Не прочитано',
                    'Прочитано',
                    'В работе',
                    'Готово',
                ],
                statusApplSelect:this.$props.applic.status,
            }
        },
        watch:{
            statusApplSelect:function(){
                if(!this.visibleStatus){
                    this.showLoader();
                    var val=this.statusApplSelect;
                    let form={
                        doc_id: this.$props.applic.doc_id,
                        status: val,
                        token: this.$props.token
                    }
                    axios.post('/api/incAppl/updateStatusDocument',form)
                    .then((response)=>{
                        this.hideLoader(),
                        swal('Статус изменен!','','success');
                    });
                }
                else{
                    swal('Нельзя менять статус просроченных заявок','','warning');
                }
            }
        },
        methods:{
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
            download(){
                this.showLoader();
                let headers={
                    responseType:'blob'
                }
                axios.post('/api/myAppl/Download',{'id':this.$props.applic.doc_id,'token':this.$props.token},headers).then((res)=>{
                    if(res.headers['filename']){                    
                        const blob = new Blob([res.data], { type: res.headers['content-type'] })
                        const downloadUrl = window.URL.createObjectURL(blob)
                        const linkUrl = document.createElement('a')
                        linkUrl.download = res.headers['filename']
                        linkUrl.href = downloadUrl
                        document.body.appendChild(linkUrl)
                        linkUrl.click()
                        document.body.removeChild(linkUrl)
                        linkUrl.remove()
                        this.hideLoader();
                    }
                    else{
                        swal({
                            title:'Файл не найден!',
                            icon:'error'});
                    }
                })
            }
        },
        mounted(){
            if(this.testDate>new Date(new Date(this.dateAppl))){
                this.visibleStatus=true;
            }
        }
    }
</script>

<style>
    .wrap-grpeo>p{
        border-bottom: 2px solid #000;
    }
    .wrap-grpeo div{
        border: 2px solid #ced4da;
        padding: 0 20px  0 20px ;
        border-radius: 15px;
    }
    .wrap-grpeo div input{
        margin-top: auto;
        margin-bottom: auto;
    }
    .field__wrapper {
        width: 100%;
        position: relative;
        text-align: center;
    }
    .field__file {
        opacity: 0;
        visibility: hidden;
        position: absolute;
    }
    .field__file-wrapper {
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
            -ms-flex-pack: justify;
                justify-content: space-between;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin: 0;
            line-height: 1.6;
    }
    .field__file-fake {
        width: calc(100% - 130px);
        padding: 5px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        border: 2px solid #ced4da;
        border-radius: 15px 0 0 15px;
        border-right: none;
    }
    .field__file-button {
        width: 130px;
        height: 100%;
        background: #3490dc;
        color: #fff;
        border-color: #3490dc;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        cursor: pointer;
    }
    .field__file-button:hover{
        background: #28679b !important;
        border-color: #28679b !important;
        color: #fff;
    }
    .field__file-button-remove{
        border-radius: 0 15px 15px 0 !important;
    }
    select{
        border-radius: 15px;
        border: 1px solid #4950574a;
        background-color: #e9ecef;
        padding: 0.375rem 0.75rem;
    }
    form .btn-download{
        width: auto !important;
    }
</style>
