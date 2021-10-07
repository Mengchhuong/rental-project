<template>
    <div style="overflow-x: hidden;">
        <div class="container-fluid">
            <div class="d-flex bd-highlight mb-3 me-5">
                <div class="me-auto p-2 bd-highlight">
                    <h2> <a href="http://localhost:3000/" style="text-decoration:none; color:black"> <b>RSM.</b></a>
                        <b-dropdown  size="sm" class="m-2 " variant="none">
                            <b-dropdown-item-button><a href="http://localhost:3000/" style="text-decoration:none; color:black"> Dashboard</a></b-dropdown-item-button>
                            <b-dropdown-item-button> <a href="http://localhost:3000/roomInfo" style="text-decoration:none; color:black">Rent</a></b-dropdown-item-button>
                            <b-button v-b-tooltip.hover.right="'Tooltip!'" variant="none">Contact us</b-button>
                            <b-button v-b-tooltip.hover.right="'Tooltip!'" variant="none">About us</b-button>
                        </b-dropdown>
                    </h2>
                </div>
                <div class="p-2 bd-highlight">
                    <button class="btn btn-light">Log out</button>
                </div>
            </div>
            <div class="container">

                <table class="table shadow ">
                    <thead>
                        <tr>
                        <th scope="col">Room No</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer tel</th>
                        <th scope="col">Rent Date</th>
                        <th scope="col">Price/month</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in listCusRent" :key="item.id">
                        <th scope="row">{{item.roomname}}</th>
                        <td>{{item.cusname}}</td>
                        <td>{{item.telephone}}</td>
                        <td>{{item.rentdate}}</td>
                        <td>{{item.price}}</td>
                        <td>{{item.status}}</td>
                        <td>
                            <b-button v-b-modal.modal-5 class="btn btn-light" @click="setid(item.id)" ><fa icon="edit"/></b-button>

                            <b-button v-b-modal.modal-6 class="btn btn-light" @click="setid(item.id)"><fa icon="sync"/></b-button>

                            <b-button v-b-modal.modal-7 class="btn btn-light" @click="setid(item.id)"><fa icon="trash" style="color:red"/></b-button>


                        </td>

                      </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <b-modal id="modal-5" title="Rent Room" ok-title="Add" variant="none" hide-header-close hide-footer ref="my-modal">
            <label for="room" class="form-label">Room No</label>
            <input type="text" class="form-control" id="room" placeholder="F202" v-model="roomupdate.roomname">
            <label for="name" class="form-label">Customer Name </label>
            <input type="text" class="form-control" id="name" v-model="roomupdate.cusname">
            <label for="phonenumber" class="form-label">Customer phonenumber </label>
            <input type="text" class="form-control" id="phonenumber" v-model="roomupdate.telephone">
            <label for="date" class="form-label">Rent Date</label>
            <input type="date" class="form-control" id="date" v-model="roomupdate.rentdate">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" v-model="roomupdate.price">
            <!-- <label for="name" class="form-label">Status </label> -->
            <!-- <select class="form-select" aria-label="Default select example">
                <option selected>Available</option>
                <option value="1">Available</option>
                <option value="2">Unavailable</option>
            </select> -->
            <label for="detail" class="form-label">Room Detail</label>
            <input type="text" class="form-control" id="detail" v-model="roomupdate.detail">
              <button class="btn btn-primary mt-3" style="float:right" type="submit" @click="update()">Edit</button>
              <button class="btn btn-secondary mt-3 me-3" style="float:right"  @click="hideModal()">Cancel</button>
            <!-- <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile">
            </div> -->
        </b-modal>

        <b-modal id="modal-6" title="Reset Status" ok-title="reset" hide-header-close ref="my-modal" hide-footer>
            <center>
                <h3>Are you sure?</h3>
                <p>you want to reset the status of this room</p>
              <button class="btn btn-primary mt-3" style="float:right" type="submit">Reset</button>
              <button class="btn btn-secondary mt-3 me-3" style="float:right"  @click="hideModal()">Cancel</button>
            </center>
        </b-modal>

        <b-modal id="modal-7" title="Delete" ok-title="delete" hide-header-close hide-footer ref="my-modal">
            <center>
                <h3>Are you sure?</h3>
                <p>you want to delete this room</p>
                <button class="btn btn-primary mt-3" style="float:right" type="submit" @click="deleteRoom()">Delete</button>
                <button class="btn btn-secondary mt-3 me-3" style="float:right"  @click="hideModal()">Cancel</button>
            </center>
        </b-modal>


    </div>
</template>

<script>
export default {
  data(){
    return{
      listCusRent:[],
      roomupdate:{},
      id:1,
    }
  },
  mounted(){
    this.$axios.get('http://localhost:8000/api/rent').then(result=>{
      this.listCusRent = result.data;
      console.log(result.data)
    }).catch(err=>err);

  },
  methods:{
    hideModal() {
      this.message=''
      this.$refs['my-modal'].hide()
    },
    setid(id){
      this.id=id;
      // console.log("rent:", id);
    },
    update() {
      console.log(this.roomupdate);
      this.$axios.put('http://localhost:8000/api/updateroom/'+this.id, this.roomupdate).then(res=>{
        console.log("update res",res.data);
        let ind = this.listCusRent.findIndex((e =>e.id = this.id));
        this.listCusRent[ind].roomname=res.data.room.roomname;
        this.listCusRent[ind].price=res.data.room.price;
        this.listCusRent[ind].detail=res.data.room.detail;
        this.listCusRent[ind].cusname = res.data.rent.cusname;
        this.listCusRent[ind].telephone = res.data.rent.telephone;
        this.hideModal();
      }).catch(err=>{
        console.log(err);
      })
    },
    deleteRoom(){
      this.$axios.delete('http://localhost:8000/api/deleteroom/'+this.id).then(res=>{
        console.log(res.data);
        let ind = this.listCusRent.findIndex((e =>e.id = this.id));
        this.listCusRent.slice(ind, 1);
        this.hideModal();

      }).catch(err=>{
        console.log(err);
      })
    }
  }
}
</script>

<style scoped>
    .container-fluid{
        margin: 16px;
        padding: 0;
    }
</style>
