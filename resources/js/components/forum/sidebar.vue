<template>
    <v-flex xs4>
        <v-card>
        <v-toolbar color="cyan" dark dense>
          <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>
        <v-list >
            <v-list-tile v-for="category in categories" :key="category.id">
                <v-list-tile-title>{{category.name}}</v-list-tile-title>
            </v-list-tile>
        </v-list>
      </v-card>
    </v-flex>
</template>

<script>
export default {
  data(){
    return {
    categories: {}
    }
  },
  created(){
      axios.get(`/api/category`)
      .then(res => {
          debugger;
          this.categories = res.data.data
        })
  },
}
</script>