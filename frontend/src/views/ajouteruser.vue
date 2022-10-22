<template>
  <div class="add_user">
    <div class="container">
      <h1>Add</h1>
      <form  @submit="Onsubmit" enctype="multipart/form-data">
      
        <label>Name :</label>
        <input type="text" :class=" name_error!='' ? 'form-control is-invalid move_input' : 'form-control '" v-model="name"  />
        <div v-if="show_error">
          <small class="text-danger" v-if="name_error != ''">
            {{ name_error }}
          </small>
        </div>
        <label>email :</label>
        <input type="email" :class=" email_error!='' ? 'form-control is-invalid move_input' : 'form-control '" v-model="email" />
        <div v-if="show_error">
          <small class="text-danger" v-if="email_error != ''">
            {{ email_error }}
          </small>
        </div>
        <label>Date :</label>
        <input type="date" class="form-control" v-model="date" :class=" date_error!='' ? 'form-control is-invalid move_input' : 'form-control '" />
        <div v-if="show_error">
          <small class="text-danger" v-if="date_error != ''">
            {{ date_error }}
          </small>
        </div>
        <label>File :</label>
        <input ref="file"  type="file" class="form-control" @change="upload_image" :class=" file_error!='' ? 'form-control is-invalid move_input' : 'form-control '"  />
        <div v-if="show_error">
          <small class="text-danger" v-if="file_error != ''">
            {{ file_error }}
          </small>
        </div>
        <button class="btn btn-outline-dark mt-2">Add</button>
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
      name_error: "",
      email_error: "",
      date: "",
      user: [],
      allerror: "",
      file: "",
      date_error:"",
      file_error:""
    };
  },
  methods: {
    upload_image() {
      this.file = this.$refs.file.files[0];
    },
    Onsubmit(e) {
      {
        this.user = {
          name: this.name,
          email: this.email,
          date: this.date,
        };
        e.preventDefault();
        const config = {
            headers: {
               'Content-Type': 'multipart/form-data',
            }
        }
        let data = new FormData();
        data.append("file",this.file);
        data.append("date_naissance",this.date);
        data.append("name",this.name);
        data.append("email",this.email);
        axios
          .post("http://localhost:8000/api/user_made", data, config)
          .then(() => {
            this.name = "";
            this.email = "";
            this.date = "";
            this.show = false;
            this.$router.push({ name: "home" });
          })
          .catch((res) => {
            this.show_error = true;
            this.name_error = res.response.data.data.name
              ? res.response.data.data.name[0]
              : "" ;
            this.email_error = res.response.data.data.email
              ? res.response.data.data.email[0]
              : "";
            this.date_error=res.response.data.data.date_naissance
              ? res.response.data.data.date_naissance[0] : "" ; 
              this.file_error=res.response.data.data.avatar
              ? res.response.data.data.avatar[0] : "" ; 
          });
      }
    },
  },
};
</script> 

<style>
.move_input{
  animation: animate 0.5s ;
}
@keyframes animate {
  0%{
    transform: translateX(10px);
  }
  50%{
    transform: translateX(-10px);
  }
  100%{
    transform: translateX(0);
  }
}
</style>