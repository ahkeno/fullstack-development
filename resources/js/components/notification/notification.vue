<template>
    <v-menu offset-y v-if="read.length || unread.length">
        <v-btn icon class="white--text" slot="activator">
            <v-icon color="red">add_alert</v-icon>{{unread.length}}
        </v-btn>
      <v-list>
        <v-list-tile v-for="item in unread" :key="item.id">
            <router-link :to="item.path">
            <v-list-tile-title @click="readIt(item)">{{item.question}}</v-list-tile-title>
            </router-link>
        </v-list-tile>
        
        <v-list-tile v-for="item in read" :key="item.id">
          <v-list-tile-title>{{item.question}}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
   
</template>
<script>
export default {
    name: 'notification',
    data(){
        return{
            read: {},
            unread: {},
            unreadCount: 0,
        }
    },
    created(){
        if (User.isLoggedIn()){
            this.getNotifications();
        }
        Echo.private('App.User.' + User.id())
	      .notification((notification) => {
	          this.unread.unshift(notification)
	          this.unreadCount++
	      });
        
    },
    computed:{
       
    },
    methods:{
        getNotifications(){
            axios.post('/api/notification')
            .then(res => {
                this.read = res.data.read
                this.unread = res.data.unread
                this.unreadCount = res.data.unread.length
                })
            .catch((err) => console.log("error"))
        },
        readIt(notification){
            debugger;
            axios.post("/api/markAsRead", { id: notification.id }).then(res =>
             {
               this.unread.splice(notification, 1);
                this.read.push(notification);
                this.unreadCount--;
            });
        }
    }
}
</script>
