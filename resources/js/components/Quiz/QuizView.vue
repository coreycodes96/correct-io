<template>
    <div>
        <!-- Create Quiz -->
        <CreateQuiz />

        <!-- Show Quizzes -->
        <ShowQuizzes :user-id="userId"/>
    </div>
</template>

<script>
import CreateQuiz from './CreateQuiz/CreateQuiz.vue';
import ShowQuizzes from './ShowQuizzes/ShowQuizzes.vue';
export default {
    props: {
        userId: {
            type: Number,
        }
    },
    components: {
        CreateQuiz,
        ShowQuizzes,
    }
}
</script>