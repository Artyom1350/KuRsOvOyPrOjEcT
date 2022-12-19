<template>
    <form class=" d-block w-50 m-auto ">
        <div class="mb-3">
            <label for="nameApplicate" class="form-label">Название:</label>
            <input type="text" class="form-control" id="nameApplicate" name="nameAppl" placeholder="Название">
        </div>
        <div class="mb-3">
            <label for="descripApplicate" class="form-label">Описание:</label>
            <textarea class="form-control" name="descripAppl" id="descripApplicate" rows="3" placeholder="Описание"></textarea>
        </div>
        <div class="mb-3">
            <label for="dateApplicate" class="form-label">Срок выполнения до:</label>
            <input type="date" class="form-control" id="dateApplicate" name="dateAppl" placeholder="Дата">
        </div>
        <div class="mb-3">
            <!-- прикрепление нескольких человек -->
            <label for="dateApplicate" class="form-label">Получатель/Получатели:</label>
            <div class="d-flex align-items-start justify-content-between">
                <div class="peopleOrGroup">

                </div>
                <!-- вызов модального окна для выбора человек/групп людей -->
                <input type="button" class="btn btn-primary" value="+"/>
            </div>
        </div>
        <div class="mb-3">
            <label for="fileApplicate" class="form-label">Прикрепить файл:</label>
            <input type="file" class="form-control btn btn-primary" name="fileApplic" id="fileApplicate">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</template>

<script>
    // import vuelidator from '@vuelidate/core';
    // import email from '@vuelidate/validators'

    export default {
        mounted() {
        },
        props: [],
        data(){
            return{
                
            }
        },
        
    }
</script>
