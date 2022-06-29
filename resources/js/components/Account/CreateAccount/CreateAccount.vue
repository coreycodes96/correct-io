<template>
    <div class="w-screen h-screen flex justify-center items-center bg-gray-100">
        <div class="sm:w-4/5 w-4/5 h-auto">
            <h4 class="mb-5 font-semibold text-2xl text-gray-700">Create An Account...</h4>

            <div class="p-10 w-full h-96 bg-white rounded shadow-md shadow-gray-400 overflow-hidden">
                <form class="w-full h-full flex justify-center flex-col items-center" @submit.prevent="createAccount">
                    <!-- Username -->
                    <div class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-600 outline-none border-b-2 border-green-500" type="text" placeholder="Username..." v-model="username" />
                        <span class="italic text-red-500" v-if="errors.username !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{errors.username}}</span>
                    </div>

                    <!-- Email -->
                    <div class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-600 outline-none border-b-2 border-green-500" type="text" placeholder="Email..." v-model="email" />
                        <span class="italic text-red-500" v-if="errors.email !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{errors.email}}</span>
                    </div>

                    <!-- Password -->
                    <div class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-600 outline-none border-b-2 border-green-500" type="password" placeholder="Password..." v-model="password" />
                        <span class="italic text-red-500" v-if="errors.password !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{errors.password}}</span>
                    </div>

                    <div class="mt-4 w-full text-white">
                        <button :disable="loading" class="p-3 w-full bg-green-500 rounded-xl" type="submit">Create Account <i v-if="loading" class="fa-solid fa-spinner animate-spin"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
export default {
    data(){
        return {
            username: "",
            email: "",
            password: "",
            errors: {
                username: "",
                email: "",
                password: "",
            },
            loading: false
        }
    },
    methods: {
        ...mapActions('account', ['createAnAccount']),
        createAccount(){
            const validEmailOnly =
                /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            //Username validation
            if(this.username === ""){
                this.errors.username = "Please enter a username";
            }else if(this.username > 25){
                this.errors.username = "Your username can't be more than 25 characters";
            }else{
                this.errors.username = "";
            }

            //Email validation
            if(this.email === ""){
                this.errors.email = "Please enter a email";
            }else if(this.email.length > 255){
                this.errors.email = "Your email can't be more than 255 characters";
            }else if(!validEmailOnly.test(this.email)){
                this.errors.email = `The email you entered (${this.email}) is invalid`;
            }else{
                this.errors.email = "";
            }

            //Password validation
            if(this.password === ""){
                this.errors.password = "Please enter a password";
            }else if(this.password.length < 8){
                this.errors.password = "Your password can't be less than 8 characters";
            }else if(this.password.length > 255){
                this.errors.password = "Your password can't be more than 255 characters";
            }else{
                this.errors.password = "";
            }

            if(this.errors.username === "" && this.errors.email === "" && this.errors.password === ""){
                this.loading = true;

                const data = {
                    username: this.username,
                    email: this.email,
                    password: this.password
                }

                this.createAnAccount(data)
                .then(() => {
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error.response);
                    this.loading = false;
                })
            }
        }
    }
}
</script>