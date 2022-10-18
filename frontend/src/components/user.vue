<template>
  <div class="user">
    <div class="container mt-5 ">
      <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                  <div class="col-md-4">
                    <span class="btn btn-outline-primary"><router-link to="/ajouteruser">Add User</router-link> </span> 

                  </div>
                  <div class="col-md-4">
                    <h6 class="m-0 font-weight-bold text-primary text-center" >User List Data Table </h6>
                  </div>
                    <div class="col-md-3">
                     <form @submit.prevent="rechercher_email_nom">
                      <input type="search" class="form-control" placeholder="search" v-model="search">
                      <button  class="btn btn-outline-success">Search</button>
                    </form>
                  </div>
                </div>
            
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
                       <tr v-for="(user) in users" :key="user.id">
                        <td>
                          {{user.id}}
                        </td>   
                        <td>
                          {{user.name}}
                        </td>
                         <td>
                             {{user.email}}
                        </td>
                        <td><button class="btn btn-danger" @click="deleteuser(user.id)">Delete</button>
                            <button  class="btn btn-warning"> <router-link :to="'/edituser/'+user.id">Edit</router-link> </button></td>
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
      user:[],
      search:null,
      $choix:'',
      message:''
    }
  },
  created(){
      axios.get("http://localhost:8000/api/user_made").then((response)=>{
          this.users=response.data.data;
      })
  },
  methods:{
    rechercher_email_nom(){
      axios.get('http://localhost:8000/api/user_made/search/'+this.search)
             .then((response)=>{
                 this.users=response.data.data;
            }).catch((response)=>{
              //  console.log(response.response.data.message);
                this.message=response.response.data.message;
            });
    },
    deleteuser(id){
      if(confirm("do you want delete this user")){
      axios.delete("http://localhost:8000/api/user_made/"+id).then(()=>{
        axios.get("http://localhost:8000/api/user_made").then((suspense)=>{
          this.users=suspense.data.data;
        })
      });
    }
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
