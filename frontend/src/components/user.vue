<template>
  <div class="user">
    <div class="container mt-5 ">
      <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-center" >User List Data Table </h6>
            </div>
          <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><input type="checkbox" id="select_all"></th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Cin</th>
                  <th scope="col">tlf</th>
                  <th scope="col">Status</th>
                  <th scope="col">operation</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>*</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Cin</th>
                  <th scope="col">tlf</th>
                  <th scope="col">Status</th>
                  <th scope="col">operation</th>
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
      idtodo:null
    }
  },
  created(){
      axios.get("http://localhost:8000/api/user_made").then((response)=>{
          this.users=response.data.data;
      })
  },
  methods:{
  
  }
}

</script>

<style scoped>

</style>
