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
            <label>Date :</label>
            <input type="date" class="form-control" v-model="date" />
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
      date:"",
      user: [],
    };
  },
  methods: {
    Onsubmit() {
      if (this.name == "" || this.email == "" || this.date == "" ) {
        this.show_error = true;
      } else {
        this.user = {
          name: this.name,
          email: this.email,
          date:this.date
        };
       
        axios
          .post("http://localhost:8000/api/user_made", this.user)
          .then(() => {
           // console.log("here");
            this.$router.push({name:"home"});
          });
          this.name = "";
          this.email = "";
          this.date = "";
          this.show = false;
      }
    },
  },
};
</script> 