<template>
    <div class="w-screen h-screen flex justify-center items-center bg-gray-100">
        <div class="w-3/5 h-auto">
            <h4 class="mb-5 font-semibold text-2xl text-gray-700">Login...</h4>

            <div class="p-10 w-full h-96 bg-white rounded shadow-md shadow-gray-400 overflow-hidden">
                <form class="w-full h-full flex justify-center flex-col items-center" @submit.prevent="login">
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
                        <button :disable="loading" class="p-3 w-full bg-green-500 rounded-xl" type="submit">Login <i v-if="loading" class="fa-solid fa-spinner animate-spin"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import { BASE_URL } from '../../../store/baseUrl';
export default {
    data(){
        return {
            email: "",
            password: "",
            errors: {
                email: "",
                password: "",
            },
            loading: false
        }
    },
    methods: {
        ...mapActions('account', ['logTheUserIn']),
        login(){
            //Email validation
            if(this.email === ""){
                this.errors.email = "Please enter a email";
            }else{
                this.errors.email = "";
            }

            //Password validation
            if(this.password === ""){
                this.errors.password = "Please enter a password";
            }else{
                this.errors.password = "";
            }

            if(this.errors.email === "" && this.errors.password === ""){
                this.loading = true;

                const data = {
                    email: this.email,
                    password: this.password
                }

                this.logTheUserIn(data)
                .then(() => {
                    this.loading = false;
                    window.location.replace(`${BASE_URL}/quiz`);
                })
                .catch(error => {
                    console.log(error.response);
                    this.loading = false;
                })
            }
        }
    },
}
</script>