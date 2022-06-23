import axios from "axios";
import { BASE_URL } from "../baseUrl";

const account = {
    namespaced: true,
    state: {
        quizzes: []
    },
    getters: {
        fetchQuizzes: state => state.quizzes
    },
    actions: {
        //Create an account
        getQuizzes({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get(`${BASE_URL}/quiz/show`, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(res => {
                        resolve(res);
                        commit('STORE_QUIZZES', res.data);
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        },
        createQuiz(NULL, data) {
            return new Promise((resolve, reject) => {
                axios.post(`${BASE_URL}/quiz/create`, data, {
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
        deleteQuiz(NULL, id) {
            return new Promise((resolve, reject) => {
                axios.delete(`${BASE_URL}/quiz/delete/${id}`, {
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
        }
    },
    mutations: {
        STORE_QUIZZES(state, data) {
            state.quizzes = data;
        }
    }
};

export default account;