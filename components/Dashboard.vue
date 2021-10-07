<template>
<div>
    <div style="overflow-x: hidden;background: linear-gradient(to bottom right, white 50%, rgb(180, 180, 180)); height:fit-content">
        <div class="container-fluid">
            <div class="d-flex bd-highlight mb-3 me-5">
                <div class="me-auto p-2 bd-highlight">
                    <h2><a href="http://localhost:3000/" style="text-decoration:none; color:black"> <b>RSM.</b> </a>
                        <b-dropdown  size="sm" class="m-2 " variant="none">
                            <b-dropdown-item-button><a href="http://localhost:3000/" style="text-decoration:none; color:black">Dashboard </a> </b-dropdown-item-button>
                            <!-- <a href="http://localhost:3000/roomInfo">Rent</a> -->
                            <b-dropdown-item-button> <a href="http://localhost:3000/roomInfo" style="text-decoration:none; color:black">Rent</a></b-dropdown-item-button>
                            <b-button v-b-tooltip.hover.right="'Tooltip!'" variant="none">Contact us</b-button>
                            <b-button v-b-tooltip.hover.right="'Tooltip!'" variant="none">About us</b-button>
                        </b-dropdown>
                    </h2>
                </div>
                <div class="p-2 bd-highlight">
                    <form id="signup" method="POST" >
                        <b-button v-b-modal.modal-1 class="btn btn-light" v-if="status == true">Sign up</b-button>

                        <b-modal id="modal-1" title="Sign up" hide-footer hide-header-close ref="my-modal">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="name" v-model="user.name" >
                             <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" v-model="user.email">
                            <label for="password" class="form-label" >Password</label> <span v-if="message != ''" style="color:red">{{this.message}}</span>
                            <input type="password" class="form-control" id="password" name="password" v-model="user.password">
                            <label for="con_pass" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="con_pass" name="password_confirmation" v-model="user.password_confirmation">
                            <button class="btn btn-primary mt-3" style="float:right" type="submit"  v-on:click="register()">Submit</button>
                            <button class="btn btn-secondary mt-3 me-3" style="float:right" @click="hideModal()">Cancel</button>

                        </b-modal>
                    </form>
                </div>

                <div class="p-2 bd-highlight">
                    <form id="signin" method="POST">
                        <b-button v-b-modal.modal-2 class="btn btn-primary" v-if="status == true">Sign in</b-button>

                        <b-modal id="modal-2" title="Sign in" ok-title="log in" hide-header-close hide-footer ref="my-modal">
                             <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="user.email">
                            <label for="password" class="form-label" >Password</label>
                            <input type="password" class="form-control" id="password" v-model="user.password">
                            <button class="btn btn-primary mt-3" style="float:right" type="submit" v-on:click="login()" @click="hideModal()">Login</button>
                            <button class="btn btn-secondary mt-3 me-3" style="float:right" @click="hideModal()">Cancel</button>

                        </b-modal>
                    </form>
                    <button class="btn btn-light" v-if="status == false" @click="logout()">Log out</button>
                </div>

            <!-- <div class="d-flex bd-highlight mb-3 me-5" v-if="status=false">
                <div class="me-auto p-2 bd-highlight">
                    <h2><b>RSM.</b>
                        <b-dropdown  size="sm" class="m-2 " variant="none">
                            <b-dropdown-item-button>Dashboard</b-dropdown-item-button>
                            <b-dropdown-item-button>Rent</b-dropdown-item-button>
                            <b-button v-b-tooltip.hover.right="'Tooltip!'" variant="none">Contact us</b-button>
                            <b-button v-b-tooltip.hover.right="'Tooltip!'" variant="none">About us</b-button>
                        </b-dropdown>
                    </h2>
                </div>
                <div class="p-2 bd-highlight">
                    <button class="btn btn-light">Log out</button>
                </div>
            </div> -->


            </div>

            <div class="row">
                <div class="col-md-6 col-sm-4 left">
                    <h1>Looking for a comfortable space to rent?</h1>
                    <p>with us we take you to get a place where you should deserve.</p>
                </div>
                <div class="col-md-6 col-sm-8 pic">
                    <img src="~/assets/img/apartment-housinganywhere-1-600x400.jpg" alt="" style="margin:0 auto; width: 90%; margin-bottom:8%;">
                </div>
            </div>

        </div>

    </div>
    <form action="" method="POST" enctype="multipart/form-data" style="margin-left:5%; margin-top:1%" v-if="status == false">
      <b-button v-b-modal.modal-4 class=" p-0" variant="none" style="color:green;" ><b style="font-size:22px;">+</b>Add Room</b-button>

      <b-modal id="modal-4" title="Rent Room" ok-title="Add" variant="none" hide-header-close hide-footer ref="my-modal">
          <label for="name" class="form-label">Room </label>
          <input type="text" class="form-control" id="name" v-model="room.roomname" placeholder="eg:F202">
          <label for="name" class="form-label">Status </label>
          <select class="form-select" aria-label="Default select example" v-model="room.status">
              <!-- <option selected>Available</option> -->
              <option value="Available">Available</option>
              <option value="Unavailable">Unavailable</option>
          </select>
          <label for="price" class="form-label">Price</label>
          <input type="number" class="form-control" v-model="room.price" id="price">
          <label for="detail" class="form-label">Room Detail</label>
          <input type="text" class="form-control" id="detail" v-model="room.detail" >
          <div class="mb-3">
              <label for="formFile" class="form-label">Default file input example</label>
              <input class="form-control" type="file" id="formFile"  multiple @change="imageChange()" ref="files" >
          </div>
          <button class="btn btn-primary mt-3" style="float:right" @click="createRoom()" type="submit" >Add</button>
          <button class="btn btn-secondary mt-3 me-3" style="float:right"  @click="hideModal()">Cancel</button>
      </b-modal>
    </form>

    <div class="container mt-3 mb-5" v-if="status == false" >
      <div  v-for="item in roomData" :key="item.id">
        <b-tabs content-class="mt-3" style="margin-bottom:3%">
            <b-tab title="Room" active>


                <div class="row">
                    <div class="col-sm-5">
                        <img :src="'http://localhost:8000'+JSON.parse(item.images)[0]" alt="" style="width:90%">
                    </div>
                    <div class="col-sm-7">
                        <p><b>{{item.roomname}}</b></p>
                        <p>Status: {{item.status}}</p>
                        <p>Detail: {{item.detail}}</p>
                        <p>Price: {{item.price}}</p>
                        <!-- <button class="btn btn-secondary" type="submit">Button</button> -->
                        <b-button v-b-modal.modal-3 class="btn btn-secondary" @click="setID(item.id)">Rent</b-button>


                    </div>
                </div>

            </b-tab>
            <b-tab title="Room Detail">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <img :src="'http://localhost:8000'+JSON.parse(item.images)[0]" alt="" style="width:100%; contain-objective:cover;">
                        <center><p>Bed Room</p></center>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <img :src="'http://localhost:8000'+JSON.parse(item.images)[1]" alt="" style="width:100%">
                        <center><p>Living Room</p></center>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <img :src="'http://localhost:8000'+JSON.parse(item.images)[2]" alt="" style="width:100%">
                        <center><p>Rest Room</p></center>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <img :src="'http://localhost:8000'+JSON.parse(item.images)[3]" alt="" style="width:100%;">
                        <center><p>Study Room</p></center>
                    </div>
                </div>
            </b-tab>
        </b-tabs>
      </div>
    </div>

    <b-modal id="modal-3" title="Rent Room" hide-footer hide-header-close ref="my-modal">
        <label for="name" class="form-label">Customer Name</label>
        <input type="text" class="form-control" id="name" v-model="customer.cusname">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="customer.cusemail">
        <label for="phonenumber" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phonenumber" v-model="customer.telephone">
        <button class="btn btn-primary mt-3" style="float:right" type="submit" @click="rentRoom()">Rent</button>
        <button class="btn btn-secondary mt-3 me-3" style="float:right"  @click="hideModal()">Cancel</button>
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="formFile" >
        </div> -->
    </b-modal>

</div>
</template>

<script>
// import authAxios from "../auth"
import axios from "axios";
// axios.defaults.withCredentials = true;
// axios.defaults.baseURL = "http://127.0.0.1:8000";
import fetchData from "../assets/src/fetchD"
export default {
   data() {
      return {
        user: {},
        status : true,
        message: "",
        images: [],
        room:{},
        roomData:[],
        customer:{},
        id:1,
      }
    },
  async mounted(){
    let result = await fetchData('http://localhost:8000/api/user', "GET","","");

    if(result){
      if(localStorage.getItem('_token')){
        this.status = false
      }else{
        this.status=true
      }

    };

    let list = await fetchData('http://localhost:8000/api/listroom',"GET","","");
    this.roomData=await list.json();
    console.log(this.roomData)
    for (const iterator of this.roomData) {
      console.log(JSON.parse(iterator.images)[0])
    }

  },

  methods: {
     hideModal() {
        this.message=''
        this.$refs['my-modal'].hide()
      },
    imageChange(){
      if(this.$refs.files.files.length<=4){
        for(let i=0;i<this.$refs.files.files.length;i++){
          this.images.push(this.$refs.files.files[i])
          console.log(this.images)
        }
      }
      else{
        alert("file upload should not exceed 4");
      }
    },
    setID(id){
      this.id=id;
    },
    rentRoom(){
      let data= this.customer;
      this.$axios.post('http://localhost:8000/api/rent/'+this.id,data).then(res=>{
        console.log(res.data);
        this.hideModal();
      }).catch(err=>{
        console.log(err);
      })
    },
    createRoom(){
      var self = this;
      let formData = new FormData();
      // for(let i=0; i<this.images.length;i++){
      //   let file = self.images[i];
      // }
    for (const iterator in this.images) {
      formData.append('files[]', self.images[iterator]);

    }
      formData.append('roomname',this.room.roomname)
      formData.append('status',this.room.status)
      formData.append('price',this.room.price)
      formData.append('detail',this.room.detail)
      console.log(formData.get("files[]"))

      // const config ={
      //   headers:{
      //           'Content-Type': "application/json",
      //           "Accept": "application/json",

      //    }
      // }
      // axios.post("http://127.0.0.1:8000/api/createroom", formData,config).then(response=>{
      //     self.$refs.files.value="";
      //     self.images=[];
      // }).catch(error=>{
      //   console.log(error);
      // })
      fetch('http://localhost:8000/api/createroom',{
        method:"POST",
        body:formData

      }).then(res=>res.json())
      .then(res=>{
        this.roomData.push(res)
        })
      this.hideModal();
    },




    async login(){
        await fetch('http://localhost:8000/api/login',{
            method: "POST",
            headers:{
                'Content-Type': "application/json",
                "Accept": "application/json"
            },
            body:JSON.stringify(this.user)
        }).then(async res=>{
            // console.log(res.json());
            let datat = await res.json();
            this.user.email='',
            this.user.password='',
            console.log(datat);

            if(datat.message=="Bad creds"){
              this.status = true
              alert("Log in Failed");
            }
            else{
              localStorage.setItem("_token", datat.token);
              this.status= false
              alert("You are login");
            }

            // if(localStorage.getItem("_token")){

            // }
            // return datat;
        }).catch(err=>{
          console.log("err",err)
        })
    },

    checkValidatePassword(){
        //^ mean start (?=.*[a-z]) at least one symbol lowercasr
        //(?=.*[A-Z]) at least one uppercase
        //(?=.*[0-9]) at least on number
        //(?=.*[!@#$%^&*]]) at least one special but I wont use it
        //(?=.{8,}) range 8 character up
        const validatePassword = RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/)
        console.log(validatePassword.test(this.user.password))
        if(validatePassword.test(this.user.password)){
            return true;
        }
        else{
            console.log("false")
            return false;
        }
    },

    async logout(){
        let result = await fetch('http://localhost:8000/api/logout',{
            method:"POST",
            headers:{
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('_token')
            }
        })
        if(result.ok){
            localStorage.clear();
            this.status=true
        }
    },


    // login() {
    //   axios.get("/sanctum/csrf-cookie").then(response => {
    //     console.log(response); //This is one success but it did set cookie in application cookie
    //     axios
    //       .post("/login", {
    //         email: "admin@gmail.com",
    //         password: "123456"
    //       })
    //       .then(res => {
    //         console.log(res);
    //       }); // this one failed with 419 csrf token mismatch
    //   });
    // },
    register(){
      let check =this.checkValidatePassword()
      const datas = {
        email: this.user.email,
         name: this.user.name,
         password:this.user.password,
         password_confirmation: this.user.password_confirmation}

      if(datas.password== datas.password_confirmation && check== true){
          this.hideModal(),
          this.$axios.post("http://localhost:8000/api/register",
          //    headers: {
          //             'Content-Type': 'application/json',
          //             // 'Access-Control-Allow-Methods': 'GET, POST, PUT',
          //             // 'Access-Control-Allow-Headers': 'Content-Type'
          //             // 'Authorization': 'JWT fefege...'
          //         }
        datas).then(res=>{
          console.log("created",res.data)
          this.user.name='',
          this.user.email='',
          this.user.password='',
          this.user.password_confirmation=''
         alert('the user is created');
          // setTimeout( function ( ) { alert( "the user is created" ); },2000 );
        }).catch(err=>{
                console.log("err",err)
            })
      }
      else if(datas.password=='' || datas.password_confirmation==''){
        this.message="Password or Confirm Password should not be empty"
      }
      else if(datas.password !=datas.password_confirmation){
        this.message="Password doesn't match!"
      }
      else if (check==false){
        this.message="check pws format: 1 lowercase 1 upper case 1 special character 1 number and 8 range"
      }
      console.log(this.user)
    }
  }
};
// export default {
//     data() {
//       return {
//         user: {}
//       }
//     },



//       async register(){
//           await authAxios("post", "register", this.user);
//             //    headers: {
//             //         'Content-Type': 'application/json',
//             //         // 'Authorization': 'JWT fefege...'
//             //     }
//         //  },this.user ).then(res=>{
//         //       console.log("created",res.data)
//         //   }).catch(err=>{
//         //       console.log("err",err)
//         //   })
//       }
//     }
// }
</script>

<style scoped>
    .container-fluid{
        margin: 16px;
        padding: 0;

    }
    .left{
        text-align: center;
    }


</style>
