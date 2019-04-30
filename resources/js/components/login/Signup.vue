<template>
     <v-container>
        <v-form  @submit.prevent="signUp">
            
            <v-text-field
            label="Name"
            v-model="form.name"
            required
            ></v-text-field>
            <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
             <v-text-field
            label="Email"
            v-model="form.email"
            required
            ></v-text-field>
            <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>

            <v-text-field
            label="Password"
            v-model="form.password"
            required
            ></v-text-field>
            <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>

            <div>
                <v-btn
                type="submit"
                color="green"
                >SignUp</v-btn>

                <router-link to="/login"><v-btn color="blue">Login</v-btn></router-link>
           </div>
        </v-form>
  </v-container>
</template>
<script>
export default {
    data(){
        return {
          form:{
              password:null,
              email:null,
              name: null
            },
            errors:{
                password:null,
                email:null,
                name: null
            }
         }
    },
    methods:{
        signUp(){
            axios.post('/api/auth/signup', this.form)
            .then(res   => { 
                User.respondAfterLogin(res)
                this.$router.push({name:'forum'})
                })
            .catch(error=> {
                this.errors = error.response.data.errors
                });
        }
    }
}
</script>

