import {defineStore} from 'pinia';
import { useRouter } from "vue-router";
import { useToast } from "vue-toast-notification";
import axios from "@/axios";

export const authStore = defineStore('auth',{
    state: () => ({
        account:false,
        user:localStorage.getItem('user'),
        router:useRouter(),
        toast:useToast(),
         form : {
            email: "admin@gmail.com",
            password: "1234",
        },
    }),
    actions:{
        userprofile() {
            document.getElementById("user").classList.toggle("show");
          },
          menu(){
            $("#wrapper").toggleClass("toggled");
          },
    
        login(){
            console.log(this.form)
            axios.post("/login", this.form).then((res) => {
              if (res.status == 201) {
                  localStorage.setItem("token", res.data.token);
                  localStorage.setItem("user", res.data.user.name);
                  this.router.push({ name: "Dashboard" });
              } else {
                  alert("error");
              }
          });
        },
        logout(){
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            this.router.push({name:'Login'});
            // this.toast.success('testad ad', {
            //     position: "top-right",
            // });

        }
    }
       
})