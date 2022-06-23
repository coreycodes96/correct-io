<template>
    <div>
        <template v-if="loading">
            <div class="w-full h-350 flex justify-center items-center">
                <i class="fas fa-spinner text-4xl animate-spin"></i>
            </div>
        </template>

        <template v-else>
            <div class="my-2 mx-auto w-4/5 flex justify-start items-center text-gray-800">
                <select v-model="option">
                    <option value="">Filter</option>
                    <option value="All">All</option>
                    <option value="General">General</option>
                    <option value="Sport">Sport</option>
                    <option value="Maths">Maths</option>
                    <option value="English">English</option>
                    <option value="Science">Science</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Music">Music</option>
                    <option value="Movies">Movies</option>
                </select>
            </div>
            
            <div v-if="filteredQuizzes.length === 0" class="w-full h-350 flex justify-center items-center">
                <p class="text-3xl">No Quizzes</p>
            </div>
            
            <template v-if="!isQuiz">
                <div v-for="quiz in filteredQuizzes" :key="quiz.id" class="mt-10 select-none">
                    <div class="relative my-10 mx-auto p-5 w-4/5 bg-white shadow-md shadow-gray-300 rounded">
                        <p class="absolute top-2 right-2 p-1.5 bg-green-500 text-white rounded text-sm">{{quiz.category}}</p>
                        <h3 class="text-xl font-semibold text-gray-700">{{quiz.title}}</h3>
                        <p class="mt-5 text-base text-gray-700">{{quiz.description}}</p>
                        <div class="w-full flex justify-between items-center">
                            <button @click="takeQuiz(quiz.id)" class="mt-5 p-2 bg-green-500 text-sm text-white rounded">Take Quiz</button>
                            <p class="mt-5 text-gray-700">Questions: {{quiz.questions.length}}</p>
                            <DeleteQuiz v-if="quiz.user_id === userId" :quiz-id="quiz.id" />
                        </div>
                        <div class="mt-5 w-full flex justify-between items-center text-xs text-gray-700">
                            <p v-if="quiz.user.username">Created By {{quiz.user.username}}</p>
                            <p>{{timeSince(quiz.created_at)}} ago</p>
                        </div>
                    </div>
                </div>
            </template>

            <template v-else>
                <PlayQuiz :isQuiz.sync="isQuiz" :quiz="selectedQuiz" />
            </template>
        </template>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import PlayQuiz from '../PlayQuiz/PlayQuiz.vue';
import DeleteQuiz from '../DeleteQuiz/DeleteQuiz.vue';
import formatDistance from 'date-fns/formatDistance';
export default {
    props: {
        userId: {
            type: Number,
        }
    },
    components: {
        PlayQuiz,
        DeleteQuiz,
    },
    data(){
        return {
            isQuiz: false,
            selectedQuiz: null,
            loading: false,
            option: 'All',
        }
    },
    methods: {
        ...mapActions('quiz', ['getQuizzes']),
        takeQuiz(id){
            this.isQuiz = true;

            const getQuiz = this.fetchQuizzes.find(quiz => quiz.id === id);

            this.selectedQuiz = getQuiz;
        },
        timeSince(date) {
            return formatDistance(new Date(), new Date(date));
        }
    },
    computed: {
        ...mapGetters('quiz', ['fetchQuizzes']),
        filteredQuizzes(){
            if(this.option === '' || this.option === 'All') return this.fetchQuizzes;

            const filtered = this.fetchQuizzes.filter(quiz => quiz.category.toLowerCase() === this.option.toLowerCase());

            return filtered;
        }
    },
    created(){
        this.loading = true;

        this.getQuizzes()
        .then(() => {
            this.loading = false;
        })
    }
}
</script>