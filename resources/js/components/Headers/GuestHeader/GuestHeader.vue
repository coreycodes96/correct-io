<template>
    <div
        class="fixed top-0 left-0 py-5 px-10 w-full h-auto flex justify-between items-center text-center bg-white">
        <li class="list-none">
            <a :href="url('')">Home</a>
        </li>

        <li class="list-none">
            <a :href="url('register')">Create Account</a>
        </li>

        <li class="list-none">
            <a :href="url('login')">Login</a>
        </li>
    </div>
</template>

<script>
export default {
    methods: {
        url(name) {
            return `/${name}`;
        }
    }
}
</script>