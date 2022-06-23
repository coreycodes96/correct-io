<template>
    <div class="fixed top-0 left-0 px-10 w-full h-auto md:flex block justify-between items-center text-center bg-gray-100">
        <li class="my-0 list-none">
            <a :href="url('')">Home</a>
        </li>

        <li class="md:0 my-5 list-none">
            <a :href="url('register')">Create Account</a>
        </li>

        <li class="md:my-0 my-5 list-none">
            <a :href="url('login')">Login</a>
        </li>
    </div>
</template>

<script>
import { BASE_URL } from '../../../store/baseUrl';
export default {
    methods: {
        url(name){
            return `${BASE_URL}/${name}`;
        }
    }
}
</script>