<template>
    <v-btn icon @click="likeIt">
        <v-icon :color="ownColor">favorite</v-icon> {{count}}
    </v-btn>
</template>
<script>
export default {
    props:['isliked','count','id'],
    name: "favourite",
    data(){
        return {
           likeCount : 0,
           like : false
        }
    },
    methods:{
        likeIt(){
            
            if(User.isLoggedIn()){
                this.isliked ? this.decr() : this.incr()
	            this.isliked = !this.isliked
            }
        },
        decr(){
            axios.delete(`/api/like/${this.id}`)
	            .then(res => {
                    this.count --
                } )
        },
        incr(){
            axios.post(`/api/like/${this.id}`)
	            .then(res => {
                    this.count ++})
        }
        
    },
    computed:{
        ownColor(){
            return this.isliked ? 'red': 'red lighten-4';
        }
    },
    created(){
        this.like = this.isliked;
        this.likeCount = this.count;

        Echo.channel('likeChannel')
            .listen('LikeEvent', (e) => {
                if(this.id == e.id){
                    e.type== 1? this.count ++ : this.count --
                }
            });
        
    }
}
</script>

