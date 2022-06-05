<template>
    <div>
        <div class="animal-component__body"
             :class="class_select"
             @click="checkFirstStart" >
            <img :src="src_svg"
                 class="animal-component__item"
            >
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            id:Number,
            kind:String,
            src_svg:String,
            first_start:Boolean
        },
        data() {
            return {
                select: false,
                class_select:''
            }
        },
        methods:{
            checkFirstStart(){
                if(this.first_start){
                    this.startGrow();
                }else{
                    axios.get('/api/check_life_animal').then(res=>{
                        this.startGrow();
                    }).catch(err=> {
                        alert('Ошибка на сервере!')
                    })
                }
            },
            startGrow(){
                if(!this.select){
                    axios.post('/api/create_animal',{
                        id: this.id,
                        kind: this.kind,
                    }).then(res=>{
                            this.$emit('create-animal',res.data);
                            this.select = true;
                            this.class_select = 'animal-component__select';
                    }).catch(err=> {
                            alert('Ошибка на сервере!')
                            })
                }
            }
        }
    }
</script>

<style scoped>

</style>
