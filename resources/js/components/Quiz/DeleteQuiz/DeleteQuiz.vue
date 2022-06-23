<template>
    <span>
        <i @click="deleteTheQuiz" class="fas fa-trash cursor-pointer mt-5 text-red-600 text-base"></i>
    </span>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    props: {
        quizId: {
            type: Number,
        },
    },
    methods:{
        ...mapActions('quiz', ['getQuizzes', 'deleteQuiz']),
        deleteTheQuiz(){
            this.deleteQuiz(this.quizId)
            .then(() => {
                this.getQuizzes();
            })
        }
    }
}
</script>