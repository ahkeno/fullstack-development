class AppStorage {
    store(user,token){
        localStorage.setItem('app_user',user)
        localStorage.setItem('app_token',token)
    }
    clear(user,token){
        localStorage.removeItem(user);
        localStorage.removeItem(token);
    }
    getToken(){
        debugger;
        return localStorage.getItem('app_token');
    }
    getUser(){
        return localStorage.getItem('app_user');
    }
}
export default AppStorage = new AppStorage;