<template>
    <v-container>
        <v-form  @submit.prevent="login">
            
            <v-text-field
            label="Email"
            v-model="form.email"
            required
            ></v-text-field>

            <v-text-field
            label="Password"
            v-model="form.password"
            required
            ></v-text-field>

            <v-btn
            type="submit"
            color="green"
            >Login</v-btn>
            
            <router-link to="/signUp"><v-btn color="blue">SignUp</v-btn></router-link>

        </v-form>
  </v-container>
</template>
<script>
export default {
    data(){
      return {
          form:{
              password:null,
              email:null
            }
         }
    },
    methods:{
        login(){
            User.login(this.form);
            window.location = '/forum';
            //this.$router.push({name:'forum'})
        }
    }
}
</script>

    
