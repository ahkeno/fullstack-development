class AppStorage {
    store(user,token){
        localStorage.setItem('app_user',user)
        localStorage.setItem('app_token',token)
    }
    clear(user,token){
        localStorage.removeItem('app_user');
        localStorage.removeItem('app_token');
    }
    getToken(){
        return localStorage.getItem('app_token');
    }
    getUser(){
        return localStorage.getItem('app_user');
    }
}
export default AppStorage = new AppStorage;