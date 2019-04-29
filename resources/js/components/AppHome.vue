<template>
    <div>
    <toolbar></toolbar>
    <router-view></router-view>
    <app-footer></app-footer>
    </div>
</template>
<script>
import toolbar from './toolbar';
import AppFooter from './footer';
import Login from './login/Login';
export default {
    components : {toolbar,AppFooter,Login}
    
}
</script>
<style>

</style>


