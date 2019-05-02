<template>
  <div class="mt-2 ml-4 mr-4">
      <markdown-editor v-model="body"></markdown-editor>
      <v-btn color="success" @click.prevent="submit">Reply</v-btn>
  </div>
</template>

<script>
export default {
    props:['question'],
  data(){
      return {
          body:null,
          id:null
      }
  },
  created(){
      this.id = this.question;
  },
  methods:{
      submit(){
          debugger;
         
          axios.post(`/api/question/${this.id}/reply`,{body:this.body})
          .then(res => {
              this.body = ''
              EventBus.$emit('gotReply',res.data.reply)
            })
      }
  }
}
</script>