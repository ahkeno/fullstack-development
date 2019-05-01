import Token from './Token';
import AppStorage from './AppStorage';
class User{
    login(request){
        axios.post('/api/auth/login',request)
            .then(res   => { 
                this.respondAfterLogin(res);
              //Token.payload(res.data.access_token)  
            })
            .catch(error=> console.log(error))
    }
    respondAfterLogin(res){
        const access_token = res.data.access_token;
        const username = res.data.user;

        if(Token.isValid){
            AppStorage.store(username,access_token);
        }
    }
    hasToken(){
        const storeToken = AppStorage.getToken();
        if(storeToken){
            return Token.isValid(storeToken)? true: false
        }
        return false;
    }

    isLoggedIn(){
        return this.hasToken();
        window.location = '/forum';
    }

    logout(){
        debugger;
        AppStorage.clear();
        window.location = '/login';
    }

    name(){
        if(this.isLoggedIn()){
            return AppStorage.getUser();
        }
    }
    id(){
        if(this.isLoggedIn()){
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub;
        }
    }
    own(id){
        debugger;
        return this.id() == id 
    }

}
export default User = new User;