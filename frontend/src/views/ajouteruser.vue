<template>
    <div class="add_user">
        <div class="container">
          <h1>Add</h1>
          <form @submit.prevent="Onsubmit">
            <div v-if="show_error_field!=''" class="alert alert-danger">
                      {{show_error_field}}
               <!--<template  v-for="(error) in allerror">
                    <p v-for="(err) in error" :key="err">
                        {{err}}
                    </p>
               </template >-->
            </div>
            <label>Name :</label>
            <input type="text" class="form-control" v-model="name" />
              <div v-if="show_error" >
                <small class="text-danger" v-if="name_error!=''"> {{name_error}}</small>  
              </div>
            <label>email :</label>
            <input type="email" class="form-control" v-model="email" />
            <div v-if="show_error" >
              <small  class="text-danger"  v-if="email_error!=''"> {{email_error}}</small>  
            </div>
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
      show_error_field:'',
      name: "",
      email: "",
      name_error:'',
      email_error:'',
      date:"",
      user: [],
      allerror:''
    };
  },
  methods: {
    Onsubmit() {
      if (this.name == "" || this.email == "" || this.date == "" ) {
          this.show_error_field = 'All Field Required';
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
           this.name = "";
           this.email = "";
           this.date = "";
           this.show = false;
           this.show_error_field='';
            this.$router.push({name:"home"});
          }).catch((res)=>{
              this.show_error = true;
              this.show_error_field='';
              this.name_error=res.response.data.data.name[0];
              this.email_error=res.response.data.data.email[0];
          });
      }
    },
  },
};
</script> 