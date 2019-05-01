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
                <v-btn flat color="success">{{question.replies_count}} Replies</v-btn>
                </v-card-title>   
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
      }
  },
  created(){
    console.log("Come to single Created");
    debugger;
          axios.get(`/api/question/${this.$route.params.slug}`)
          .then(res => {
              this.question = res.data.data
              this.replies = res.data.replies
              this.replyCount = res.data.replyCount
            })
  }
}
</script>