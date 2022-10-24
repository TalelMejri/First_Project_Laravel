<template>
    <div>
        <b-tabs v-for="user in users" :key="user.id" content-class="mt-3">
            <b-tab title="Data" active>
                <h1>
                    {{ user.id }}
                  </h1>
                  <h1>
                    {{ user.name }}
                  </h1>
                  <h1>
                    {{ user.email }}
                  </h1>
                  <h1>
                    {{ user.date_naissance }}
                  </h1>
            </b-tab>
            <b-tab title="Avatar"><img alt="idk" :src="'http://localhost:8000'+user.avatar"/></b-tab>
            <b-tab title="Photo d'identite"><img alt="idk" :src="user.photo_identity"/></b-tab>
        </b-tabs>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name:"UsersCard",
    data(){
        return{
            users:[]
        }
    },
    created(){
        axios.get('http://localhost:8000/api/user_made')
        .then(r=>{
            this.users = r.data.data;
        });
    }
}
</script>

<style>

</style>