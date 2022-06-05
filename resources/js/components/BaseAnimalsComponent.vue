<template>
<div>
    <div class="menu-animal-list__wrapper">
        <div class="menu-animal-list__container"
            >
            <div class="menu-animal-list__container_btn" :class="class_menu_color">
                <button href="#" class="menu-animal-list__menu_btn" @click="openMenu">+</button>
            </div>
            <div class="menu-animal-list__body"
                 :class = '[class_menu_list,class_menu_color]'
            >
                <template v-if="animals_data.length !== 0">
                    <template v-for="param in animals_data">
                        <div class="menu-animal-list__item">
                            <animal   :key="param.id"
                                      :id="param.id"
                                      :kind="param.kind"
                                      :first_start="first_start"
                                      :src_svg="getSrcSvg(param.kind)"
                                      @create-animal="createUserAnimal"
                            ></animal>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </div>

    <template v-if="users_animals.length !== 0">
        <div class="user-animals__body">
            <user-animal
                v-for="param in users_animals"
                :key="param.id"
                :id="param.id"
                :name="param.name"
                :kind="param.kind"
                :current_age="param.current_age"
                :current_size="param.current_size"
                :size="param.size"
                :age="param.age"
                :growth="param.growth"
                :status="param.status"
                @save-animal="saveTimeout"
            ></user-animal>
        </div>
    </template>
</div>
</template>

<script>
    import axios from 'axios';
    import AnimalComponent from "./AnimalComponent";
    export default {
        components:{
            AnimalComponent
        },
        data() {
            return {
                animals_data:[],
                users_animals:[],
                class_menu_list:'menu-animal-list__hide',
                class_menu_color:'',
                time:1000,
                first_start:false
            }
        },
        mounted() {
            this.loadAnimals();
        },
        methods:{
            loadAnimals(){
                axios.get('/api/animal_kinds')
                    .then(res=>{
                            this.animals_data = res.data;
                    }).catch(err=> {
                        alert('Ошибка на сервере!')
                    })
            },
            createUserAnimal(animal_data){
                if(this.first_start == false){
                    this.first_start = true;
                }
                this.users_animals.push(animal_data);
            },
            openMenu(){
                if( this.class_menu_list == 'menu-animal-list__hide' && this.animals_data.length !== 0){
                    this.class_menu_list = 'menu-animal-list__show';
                    this.class_menu_color = 'menu-animal-list__color';
                }else if(this.animals_data.length !== 0){
                    this.class_menu_list = 'menu-animal-list__hide';
                    this.class_menu_color = '';
                }else{
                    alert('Ошибка на сервере!')
                }
            },
            getSrcSvg(kind){
                return "svg\\"+kind+".svg"
            },
            saveTimeout(animal_data){
                this.time = this.time + 500;
                setTimeout(function () {
                    this.saveData(animal_data);
                }.bind(this), this.time)
            },
            saveData(animal_data){
                axios.post('/api/save_status',{
                    id: animal_data.id,
                    status: animal_data.status,
                    current_size: animal_data.current_size,
                    current_age: animal_data.current_age,
                }).then(res=>{
                    if(res.data.status_life == false){
                        this.time = 1000;
                    }

                })
            },
        }
    }
</script>

<style scoped>

</style>
