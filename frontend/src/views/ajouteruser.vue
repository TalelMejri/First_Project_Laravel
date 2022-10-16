<template>
    <div class="add_user">
        <div class="container">
          <h1>Add</h1>
          <form @submit.prevent="Onsubmit">
            <div v-if="show_error" class="alert alert-danger">
              all fileds required
            </div>
            <label>Name :</label>
            <input type="text" class="form-control" v-model="name" />
            <label>email :</label>
            <input type="email" class="form-control" v-model="email" />
            <button  class="btn btn-outline-dark mt-2">
              Add
            </button>
          </form>
        </div>
    </div>
</template>


<script>
import axios from "axios";
export default {
  name: "adduser",
  data() {
    return {
      show_error: false,
      name: "",
      email: "",
      user: [],
    };
  },
  methods: {
    Onsubmit() {
      if (this.name == "" || this.email == "") {
        this.show_error = true;
      } else {
        this.user = {
          name: this.name,
          email: this.email,
        };
        /* if(this.edit==true){
        this.name='';
        this.email='';
        axios.put("http://localhost:8000/api/user_made/"+this.iduser,this.user).then(()=>{
          axios.get("http://localhost:8000/api/user_made").then((suspense)=>{
            this.users=suspense.data.data;
          })
        })
      }else{*/
        axios
          .post("http://localhost:8000/api/user_made", this.user)
          .then((suspense) => {
            this.$router.push({name:"home"});
          });
          this.name = "";
          this.email = "";
          this.show = false;
      }
    },
  },
};
</script> 