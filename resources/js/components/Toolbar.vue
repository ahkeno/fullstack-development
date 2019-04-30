<template>
  <v-toolbar color="indigo lighten-1" class="white--text">
    <v-toolbar-title>I am toolbar</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-side-icon class="hidden-md-and-up"></v-toolbar-side-icon>
   <div class="hidden-sm-and-down">
      <span v-for="item in items " :key="item.title">
        <router-link 
        :to="item.to" 
        v-if="item.show">
        <v-btn class="white--text" flat>{{item.title}}</v-btn>
        </router-link>
      
      </span>
       
   </div>    
  </v-toolbar>
</template>

<script>

export default {
  components:{},
  data(){
    return {
      items:[
        {title: "Forum",to:"/forum",show:true},
        {title: "Ask Question",to:"/ask",show: User.isLoggedIn()},
        {title: "Category",to:"/category",show:User.isLoggedIn()},
        {title: "Login",to:"/login",show:!User.isLoggedIn()},
        {title: "Logout",to:"/logout",show:User.isLoggedIn()},
      ]
      
    }
  },
  created(){
    EventBus.$on('logout',()=>{
      User.logout()
    });
  }
}
</script>