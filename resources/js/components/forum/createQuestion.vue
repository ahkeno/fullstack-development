<template>
    <v-container class="mb-4">
    <h1>Ask new Question</h1>
  <v-form  @submit.prevent="submit">
    <v-text-field
      label="Title"
      v-model="form.title"
      required
    ></v-text-field>

    <v-select
        :items="categories"
        v-model="form.category_id"
        item-text="name"
        item-value="id"
        label="Select"
        autocomplete
    ></v-select>
    
    <markdown-editor v-model="form.body"></markdown-editor>

    <v-btn
    type="submit"
    color="indigo"
    class="white--text"
    >Submit</v-btn>
    
    <router-link to="/login"><v-btn color="success">All </v-btn></router-link>

  </v-form>
  </v-container>
    
</template>
<script>
export default {
    data(){
        return{
            form:{
              title:null,
              body:null,
              category_id:null
          },
          categories: null,
          errors: {}
        }
    },
    created(){
        
        this.getCategory();
        
    },
    methods:{
        submit(){
            console.log(this.form);
            debugger;
            axios.post('api/question',this.form)
            .then(res=> console.log("question created:"))
            .catch(error => {
                this.error = error.response.data;
                //Exception.handle(this.error);
                console.error("Submit",this.error);
                })
        },
        getCategory(){
            axios({
            method:'get',
                url : '/api/category',
            })
            .then(res => {
                
                this.categories = res.data.data
            
            } )
        }
    }
}
</script>
<style>

</style>


