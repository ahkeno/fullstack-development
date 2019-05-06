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
                this.like ? this.decr() : this.incr()
	            this.like = !this.like
            }
        },
        decr(){
            axios.delete(`/api/like/${this.id}`)
	            .then(res => {
                    
                    this.count --
                    this.isliked = false
                } )
        },
        incr(){
            axios.post(`/api/like/${this.id}`)
	            .then(res => {
                     
                    this.count ++
                    this.isliked = true})
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
        
    }
}
</script>

