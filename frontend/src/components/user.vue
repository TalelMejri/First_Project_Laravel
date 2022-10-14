<template>
  <div class="user">

    <div class="container mt-5 ">
      <div  v-if="show"  class="popup-below">
        <div v-if="show" class="popup_magasin">
          <h1 v-if="edit">Update</h1>
           <h1 v-if="add">Add</h1>
            <form  @submit.prevent="Onsubmit">
                 <div v-if="show_error" class="alert alert-danger">
                      all fileds required
                 </div>
                <label >Name :</label>
                <input type="text" class="form-control" v-model="name">
                <label >email :</label>
                <input type="email" class="form-control" v-model="email">
                <button class="btn btn-outline mt-2 text-white" :style="{ backgroundColor:add == true ? 'green' : 'orange'}" >{{add== true ? "add" : "update"}}</button>
                <button class="btn btn-outline-secondary mx-2 mt-2" @click="show=false">console</button>
            </form>
           </div>
           </div>
      <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-center" >User List Data Table </h6><span class="btn btn-outline-primary" @click="addscreen()" >Add User</span> 
            </div>
          <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>*</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
               
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>*</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th>operation</th>
               
                </tr>
              </tfoot>
                   
                  <tbody v-if="users==''">
                    <tr class="table-primary" >
                      <td class="text-center py-4" colspan="7">
                              <p class="fw-bolder text-danger">No matching records found</p> 
                      </td>
                     </tr>
                </tbody>
                <tbody v-else>
                       <tr v-for="(user,index) in users" :key="user.id">
                        <td>
                          {{index}}
                        </td>   
                        <td>
                          {{user.name}}
                        </td>
                         <td>
                             {{user.email}}
                        </td>
                        <td><button class="btn btn-danger" @click="deleteuser(user.id)">Delete</button>
                          <button class="btn btn-warning mx-2" @click="editUser(user)">Edit</button></td>
                       </tr>
                </tbody>
             </table>
        </div>
      </div>
    </div>
 </div>
        
</template>

<script>
import axios from "axios";
export default {
  name: 'user',
  data(){
    return{
      users:[],
      iduser:null,
      show:false,
      show_error:false,
      name:'',
      edit:false,
      add:false,
      user:[],
      email:''
    }
  },
  created(){
      axios.get("http://localhost:8000/api/user_made").then((response)=>{
          this.users=response.data.data;
      })
  },
  methods:{
    deleteuser(id){
      if(confirm("do you want delete this user")){
      axios.delete("http://localhost:8000/api/user_made/"+id).then(()=>{
        axios.get("http://localhost:8000/api/user_made").then((suspense)=>{
          this.users=suspense.data.data;
        })
      });
    }
    },
    addscreen(){
     this.name='';
     this.email='';
     this.edit=false;
     this.add=true;
     this.show=true;
    },
    Onsubmit(){
      if(this.name=="" && this.email==""){
        this.show_error=true;
      }else{
      this.user={
         name:this.name,
         email:this.email
      }
      if(this.edit==true){
        this.name='';
        this.email='';
        axios.put("http://localhost:8000/api/user_made/"+this.iduser,this.user).then(()=>{
          axios.get("http://localhost:8000/api/user_made").then((suspense)=>{
            this.users=suspense.data.data;
          })
        })
      }else{
      axios.post("http://localhost:8000/api/user_made",this.user).then((suspense)=>{
        axios.get("http://localhost:8000/api/user_made").then((suspense)=>{
          this.users=suspense.data.data;
        })
      });
    }
    this.name='';
    this.email='';
    this.show=false;
  }
  },
  editUser(user){
    this.show=true;
    this.edit=true;
    this.add=false;
    this.iduser=user.id;
    this.name=user.name;
    this.email=user.email;
  },

  }
}

</script>

<style scoped>
.popup-below {
  position: fixed; /* Stay in place */
  z-index: 999999999;
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.popup_magasin{
  position: fixed;
  top: 50%;
  left: 50%;
  flex-direction: column;
  border-radius: 5%;
  transform: translate(-50%,-50%);
  background: #fff;
  width: 450px;
  height: 330px;
  z-index: 999999999;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 90px;
}
</style>
