<template>
    <div class="edit">
        <div class="container">
            <h1>Update</h1>
            <div v-if="message!=''" class="alert alert-danger">
                {{ message }}
            </div>
            <form @submit.prevent="edit" enctype="multipart/form-data">
              <label>Name :</label>
              <input type="text" class="form-control" v-model="name" />
              <label>email :</label>
              <input type="email" class="form-control" v-model="email" />
              <label>date :</label>
              <input type="date" class="form-control" v-model="date" />
              <img :src="'http://localhost:8000'+image" width="50px" height="50px">
              <label>File :</label>
              <input  ref="file"  type="file" class="form-control" @change="edit_image" />
              <button class="btn btn-outline-warning mt-2">
                Edit
              </button>
            </form>
          </div>
    </div>
</template>

<script>
import axios from 'axios';
export default{
    name:'edituser',
    data(){
        return{
            name:'',
            email:'',
            date:'',
            image:'',
            id:'',
            message:'',
            file:'',
            upload_image:0
        }
    },
    created(){
        this.id = this.$route.params.id;
        axios.get('http://localhost:8000/api/user_made/findbyid/'+this.id).then((suspence)=>{
          this.name=suspence.data.data.name;
          this.email=suspence.data.data.email;
          this.date=suspence.data.data.date_naissance;
          this.image=suspence.data.data.avatar;
        })
    },
    methods:{
        edit_image() {
            this.file = this.$refs.file.files[0];
            this.upload_image=1;
         },
        edit(e){
            this.user={
                name:this.name,
                date:this.date,
                email:this.email
            }
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
        data.append("upload_image",this.upload_image);
        data.append("email",this.email);
            axios.post('http://localhost:8000/api/user_made/'+this.id,data,config)
            .then(()=>{
                this.$router.push({name:"home"});
            })
            .catch((res)=>{
                  this.message=res.response.data.message;
            });
        }
    }
}
</script>

