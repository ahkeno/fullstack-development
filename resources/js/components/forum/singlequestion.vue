<template>
    <div class="mt-2">
        <div v-if="question">
            <v-card>
            <v-card-title primary-title>
                <div>
                    <div class="headline">
                        <a href="" @click.prevent>{{question.title}}</a>
                    </div>
                    <span class="grey--text">{{question.user}} Said {{question.created_at}}</span>
                </div>
                <v-spacer></v-spacer>
                <!-- show body of text  -->
                <v-card-text v-html="body" v-if="!this.editing"></v-card-text>
                <!-- edit -->
                 <v-form  @submit.prevent="editQuestion" v-if="this.editing">
                    <markdown-editor v-model="question.body"  ></markdown-editor>
                    <v-btn icon small @click="cancel">
                        <v-icon color="blue">cancel</v-icon>
                    </v-btn>
                    <v-btn icon small type="submit">
                        <v-icon color="success">save</v-icon>
                    </v-btn>
                 </v-form>
                <v-btn flat color="success">{{question.reply_count}} Replies</v-btn>
                </v-card-title>   
                <div v-if="!this.editing">
                <v-card-actions v-if="own">
                    <v-btn icon small @click="openEditQuestion">
                        <v-icon color="orange">edit</v-icon>
                    </v-btn> 
                    <v-btn icon small  @click="deleteQuestion">
                        <v-icon color="red">delete</v-icon>
                    </v-btn>    
                </v-card-actions>  
                </div> 
                <!-- create reply -->
                <Create-Reply :question="question.slug"></Create-Reply>
                <!-- show reply -->
                <v-card v-for="(reply,index) in replies" :key="reply.id" :index="index">
                    <Replies v-if="replies" :content="reply" :index="index"></Replies>
                </v-card>
            </v-card>
            
        </div>
       
    </div>
</template>
<script>
import Replies from './../reply/replies';
import CreateReply from './../reply/createReply';
export default {

 data(){
      return {
          editform: {},
          editing : false,
          question:null,
          replies:null,
          own: false,
      }
  },
  created(){
        this.listen();
        this.getAllReply();
        EventBus.$on('deleteReply',(value)=>{
          axios.delete(`/api${this.$route.path}/reply/${value.id}`)
            .then(res => this.getAllReply())
            .catch(err => console.error(error))
      })

      EventBus.$on('gotReply',()=>{
        this.question.reply_count++
        this.getAllReply();
      })
  },
  computed:{
      body(){
          
          return md.parse(this.question.body);
      },
      
  },
  methods:{
      listen(){
          
      },
      getAllReply(){
          axios.get(`/api/question/${this.$route.params.slug}`)
          .then(res => {
              
              this.question = res.data.data
              this.own = User.own(this.question.userId)
              this.replies = res.data.data.replies
              this.replyCount = res.data.replyCount
            })
      },
      deleteQuestion(){
          axios.delete(`/api/question/${this.question.slug}`)
          .then(res => this.$router.push("/forum"))
          .catch(err => console.error(error))
      },
      openEditQuestion(){
          this.editing = true;
          
      },
      editQuestion(){
          if(this.editing){
              
              axios.patch(`/api/question/${this.question.slug}`,this.question.body)
                .then(res => {
                    this.cancel()
                    this.editing = false
                    })
          }
      },
      cancel(){
          EventBus.$emit('stopEditing');
      },
      
      
  },
  components: {Replies,CreateReply},

}
</script>