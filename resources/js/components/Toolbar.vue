<template>
  <v-toolbar color="indigo lighten-1" class="white--text">
    <v-toolbar-title>I am toolbar</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-side-icon class="hidden-md-and-up"></v-toolbar-side-icon>
   <div class="hidden-sm-and-down">
       <router-link to="/login" >
        <v-btn class="white--text" flat>Login</v-btn>
      </router-link>
   </div>    
  </v-toolbar>
</template>

<script>

export default {
  components:{},
  data(){
    return {
      
    }
  },
 
}
</script>