<template>
    <div class="mt-2 ml-4 mr-4">
        <div v-if="!showEdit" >
            <v-card-actions v-if="owns">
                <v-spacer></v-spacer>
                
                <v-btn icon @click="editing">
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn icon @click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
                
            </v-card-actions>
        </div>
        <v-card-title primary-title>
            <div class="headline">{{reply.user.name}}</div>
            <div class="ml-4">Said {{reply.created_at}}</div>
            <v-card-text v-if="!showEdit" v-html="body"></v-card-text>
            <div v-if="likedContent.length != 0">
            <like  :isliked = "likedContent.liked" :count="likedContent.like_count" :id="reply.id" ></like>
            </div>
           <!-- <v-btn icon @click="likeIt">
                <v-icon :color="likeColor">favorite</v-icon> {{likedContent.like_count}}
            </v-btn> -->
        </v-card-title>
        
        <!-- Edit Reply Body -->
        <v-form  @submit.prevent="editReply()" v-if="showEdit">
            <markdown-editor v-model="reply.body"  ></markdown-editor>
            <v-btn icon small @click="cancel">
                <v-icon color="blue">cancel</v-icon>
            </v-btn>
            <v-btn icon small type="submit">
                <v-icon color="success">save</v-icon>
            </v-btn>
        </v-form>
    </div>
</template>
<script>
import Like from "./../likes/like";
export default {
    name: "Replies",
    props:['content'],
    data(){
        return{
            showEdit: false,
            form:{},
            reply : {},
            likedContent:{}
        }
    },
    components:{Like},
    computed:{
       
       body(){
           return md.parse(this.reply.body)
       },
       owns(){
           
           return User.own(this.reply.user.id )
        },
        likeColor(){
            debugger;
            return this.likedContent.liked ? 'red': 'red lighten-4';
        }
    },
    created(){
        this.reply = this.content;
        this.getLike();
        
    },
    methods:{
        editing(){
            this.showEdit = true;
        },
        destroy(){
            
            EventBus.$emit('deleteReply',{id:this.reply.id,index:this.$attrs})
        },
        editReply(id,data){
            if(this.showEdit){
            axios.put(`/api${this.$route.path}/reply/${this.reply.id}`,{'body':this.reply.body})
                .then(res => {
                    this.showEdit = false
                    })
            }
        },
        cancel(){
            //EventBus.$emit('cancel');
            alert("I on cancle");
            this.showEdit = false
        },
        listener(){
        
        },
        getLike(){
            
            axios.get(`/api/question/${this.$route.params.slug}/reply/${this.reply.id}`)
          .then(res => {
              
                this.likedContent = res.data.data;
            
          })
        }
    },
    
}
</script>

