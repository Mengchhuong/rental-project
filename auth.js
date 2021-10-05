import axios from 'axios'

export default async function authAxios (method,url,data){
    var exurl="http://127.0.0.1:8000/api/"
    var result= "";
    if(method=="post"){
        result = await axios.post(exurl+url,data,{
            headers:{"Authorization": 'Bearer '+localStorage.getItem('token')}
        })
    }
    else if(method=="get"){
        result = await axios.get(exurl+url,{
            headers:{"Authorization": 'Bearer '+localStorage.getItem('token')}
        })
    }
    else if(method=='put'){
        result = await axios.put(exurl+url,data,{
            headers:{"Authorization": 'Bearer '+localStorage.getItem('token')}
        })
    }
    else if(method=='delete'){
        result = await axios.delete(exurl+url,{
            headers:{"Authorization": 'Bearer '+localStorage.getItem('token')}
        })
    }
    return result;
}
