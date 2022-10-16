<template>
    <div class="edit">
        <div class="container">
            <h1>Update</h1>
            <div v-if="message!=''" class="alert alert-danger">
                {{message}}
            </div>
            <form @submit.prevent="edit">
              <label>Name :</label>
              <input type="text" class="form-control" v-model="name" />
              <label>email :</label>
              <input type="email" class="form-control" v-model="email" />
              <button  class="btn btn-outline-warning mt-2">
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
            id:'',
            message:''
        }
    },
    created(){
        this.id = this.$route.params.id;
        axios.get('http://localhost:8000/api/user_made/findbyid/'+this.id).then((suspence)=>{
          this.name=suspence.data.data.name;
          this.email=suspence.data.data.email;
        })
    },
    methods:{
        edit(){
            this.user={
                name:this.name,
                email:this.email
            }
            axios.put('http://localhost:8000/api/user_made/'+this.id,this.user)
            .then((suspence)=>{
                this.$router.push({name:"home"});
            })
            .catch((res)=>{
                this.message=res.response.data.message;
            });
        }
    }
}
</script>

