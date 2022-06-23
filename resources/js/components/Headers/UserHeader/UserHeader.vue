<template>
    <div class="mt-5 mx-auto w-4/5 h-auto md:flex block justify-end items-center text-center bg-gray-100">
        <button @click="logout" class="my-2 p-2 bg-red-500 text-white rounded">Logout</button>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    methods: {
        ...mapActions('account', ['logTheUserOut']),
        logout(){
            this.logTheUserOut()
            .then(() => {
                window.location.replace(`/login`);
            })
        }
    }
}
</script>