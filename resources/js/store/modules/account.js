import { BASE_URL } from "../baseUrl";

const account = {
    namespaced: true,
    state: {
        create_account: []
    },
    getters: {},
    actions: {
        //Create an account
        createAnAccount(NULL, data) {
            return new Promise((resolve, reject) => {
                axios.post("/register", data, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(res => {
                        resolve(res);
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        },
        //Log the user in
        logTheUserIn(NULL, data) {
            return new Promise((resolve, reject) => {
                axios.post("/login", data, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(res => {
                        resolve(res);
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        },
        //Log the user out
        logTheUserOut() {
            return new Promise((resolve, reject) => {
                axios.post("/logout")
                    .then(res => {
                        resolve(res);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        }
    },
    mutations: {}
};

export default account;