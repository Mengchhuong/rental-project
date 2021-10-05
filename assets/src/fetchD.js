
  const fetchData = async(url, method,headers,data)=>{
    let res=null;
    if(method=="GET"){
      res = await fetch(url,{
        method,
        headers:{
          "Content-Type": 'application/json',
          "Accept": "application/json"
        },
        // body:JSON.stringify(data)
      });
    }
    else{
      res = await fetch(url,{
        method,
        headers:{
          "Content-Type": 'application/json',
          "Accept": "application/json"
        },
        body:JSON.stringify(data)
      });
    }

    if(Response.status==401){
      localStorage.clear();
    }

    return res;
  }



  export default fetchData;
