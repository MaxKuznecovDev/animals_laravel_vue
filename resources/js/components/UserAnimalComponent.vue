<template>
    <div>
        <img :src="getSrcSvg"
             class="user-animal-component__body"
             :style="getSizeStyle"
        >
    </div>
</template>

<script>
    export default {
        data: function () {
                return {
                    id:0,
                    current_size:0,
                    current_age:0,
                    kind:'',
                    status:'',
                    name:'',
                    size:0,
                    age:0,
                    growth:0,
                    time_life:1000
            }
        },
        computed: {
            getSrcSvg(){
                    return "svg\\"+this.kind+".svg"
            },
            getSizeStyle(){
                return {
                    'max-height': this.current_size + 'px',
                    'max-width': this.current_size + 'px',
                }
            }
        },
        created: function () {
            for (var i in this.$attrs) {
                if (i in this.$data) {
                    Vue.set(this.$data, i, this.$attrs[i])
                }
            }
                this.startGrowth();

        },
        methods:{
            startGrowth(){
                this.timerId = setInterval(function() {
                    if(this.current_size < this.size){
                        if(this.current_size == 0){
                            this.current_size =this.growth;
                        }else {
                            this.current_size = this.current_size +this.current_size*this.growth;
                            if(this.current_size > this.size){
                                this.current_size = this.size;
                            }
                            this.$emit('save-animal',{
                                id: this.id,
                                status: this.status,
                                current_size: this.current_size,
                                current_age: this.current_age,
                            });
                        }
                    }
                    if(this.current_age == this.age){
                        clearInterval(this.timerId);
                        this.status = 'dead';
                        this.$emit('save-animal',{
                            id: this.id,
                            status: this.status,
                            current_size: this.current_size,
                            current_age: this.current_age,
                        });
                    }else{
                        this.current_age++;
                    }
                     }.bind(this), this.time_life);
            }
        }
    }
</script>

<style scoped>

</style>
