export default function() {
    if(localStorage.getItem('token')) 
        return true 
    
    return '/auth/login'
}