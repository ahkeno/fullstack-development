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
                <v-card-text v-html="body"></v-card-text>
                <v-btn flat color="success">5 {{question.replies_count}} Replies</v-btn>
                </v-card-title>   
                <v-card-actions v-if="own">
                    <v-btn icon small @click="editQuestion">
                        <v-icon color="orange">edit</v-icon>
                    </v-btn> 
                    <v-btn icon small  @click="deleteQuestion">
                        <v-icon color="red">delete</v-icon>
                    </v-btn>    
                </v-card-actions>    
            </v-card>
            
        </div>
       
    </div>
</template>
<script>

export default {

 data(){
      return {
          
          editing : false,
          question:null,
          replies:null,
          own: false,
      }
  },
  created(){
    console.log("Come to single Created");
    //this.own = User.own(this.question.userId);
    debugger;
          axios.get(`/api/question/${this.$route.params.slug}`)
          .then(res => {
              this.question = res.data.data
              this.own = User.own(this.question.userId)
              this.replies = res.data.replies
              this.replyCount = res.data.replyCount
            })
  },
  computed:{
      body(){
          
          return md.parse(this.question.body);
      }
  },
  methods:{
      deleteQuestion(){
          axios.delete(`/api/question/${this.question.slug}`)
          .then(res => this.$router.push("/forum"))
          .catch(err => console.error(error))
      },
      editQuestion(){
          axios.path(`/api/question/${this.question.slug}`)
          .then(res => {
              console.log("success edit")
          })
          .catch(err => console.error(error))
      }
  }

}
</script>