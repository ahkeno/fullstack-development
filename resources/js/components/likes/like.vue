<template>
    <v-btn icon @click="likeIt">
        <v-icon :color="color">favorite</v-icon> {{count}}
    </v-btn>
</template>
<script>
export default {
    props:['liked','count'],
    name: "favourite",
    data(){
        return {
            count: 0,
            liked: Boolean
        }
    },
    methods:{
        likeIt(){

        }
    },
    computed:{
        color(){
            return this.liked ? 'red': 'red lighten-4';
        },
        getLike(){

        }
    },
    created(){
        debugger;
        
        this.liked = this.content.liked;
        this.count = this.content.count;
        
    }
}
</script>

