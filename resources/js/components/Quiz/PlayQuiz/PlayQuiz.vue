<template>
    <div class="fixed top-0 left-0 w-screen h-screen bg-gray-100 z-10">
        <div class="absolute top-5 right-5 w-full flex justify-end">
            <i v-if="!finished" @click="$emit('update:isQuiz', false)" class="fas fa-times cursor-pointer text-xl"></i>
        </div>

        <div v-if="finished" class="w-full h-full flex flex-col justify-center items-center text-gray-700">
            <p class="my-5 text-2xl">{{timeRanOut ? 'You have run out of time' : 'You have completed the quiz'}}</p>
            <p class="my-2">Your final score is {{score}}</p>
            <p class="my-2">Correct: {{correct}}</p>
            <button @click="finishedQuiz" class="mt-5 p-2 bg-green-500 text-sm text-white rounded">Done</button>
        </div>

        <template v-else>
            <div v-if="!start" class="w-full h-full flex flex-col justify-center items-center rounded">
                <h3 class="my-10 text-3xl font-semibold text-gray-700">{{quiz.title}}</h3>
                <template v-if="mode === ''">
                    <button @click="mode = 'easy', timer = 60" class="mt-5 p-2 bg-green-500 text-sm text-white rounded">Easy Mode</button>
                    <button @click="mode = 'medium', timer = 45" class="mt-5 p-2 bg-green-500 text-sm text-white rounded">Medium Mode</button>
                    <button @click="mode = 'hard', timer = 30" class="mt-5 p-2 bg-green-500 text-sm text-white rounded">Hard Mode</button>
                </template>
                <button v-if="mode" @click="startQuiz" class="mt-5 p-2 bg-green-500 text-sm text-white rounded">Start Quiz</button>
            </div>

            <div v-else class="w-screen h-screen flex flex-col justify-center items-center">
                <div class="mt-10 mx-auto p-3 w-4/5 h-500 shadow shadow-gray-300 rounded">
                    <h2 class="my-5 text-gray-700">{{currentQuestion.question}}</h2>
                    <div>
                        <div class="mb-5 w-full h-8 bg-white flex items-center">
                            <div class="flex justify-center items-center p-2 h-full bg-black text-white">A</div>
                            <button ref="answer1" @click="handleAnswer('answer1', currentQuestion.answers[0].answer1)" class="w-full h-full bg-green-500 text-white">{{currentQuestion.answers[0].answer1}}</button>
                        </div>
                        <div class="mb-5 w-full h-8 bg-white flex items-center">
                            <div class="flex justify-center items-center p-2 h-full bg-black text-white">B</div>
                            <button ref="answer2" @click="handleAnswer('answer2', currentQuestion.answers[0].answer2)" class="w-full h-full bg-green-500 text-white">{{currentQuestion.answers[0].answer2}}</button>
                        </div>
                        
                        <div v-if="currentQuestion.answers[0].answer3" class="mb-5 w-full h-8 bg-white flex items-center">
                            <div class="flex justify-center items-center p-2 h-full bg-black text-white">C</div>
                            <button ref="answer3" @click="handleAnswer('answer3', currentQuestion.answers[0].answer3)" class="w-full h-full bg-green-500 text-white">{{currentQuestion.answers[0].answer3}}</button>
                        </div>

                        <div v-if="currentQuestion.answers[0].answer4" class="w-full h-8 bg-white flex items-center">
                            <div class="flex justify-center items-center p-2 h-full bg-black text-white">D</div>
                            <button ref="answer4" @click="handleAnswer('answer4', currentQuestion.answers[0].answer4)" class="w-full h-full bg-green-500 text-white">{{currentQuestion.answers[0].answer4}}</button>
                        </div>
                    </div>

                    <div class="mt-10 w-full flex justify-between items-center text-gray-700">
                        <div class="flex items-center">
                            <i class="fa-solid fa-calculator mr-1"></i>
                            <p>{{score}}</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-hourglass-start mr-1"></i>
                            <p>{{timer}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        isQuiz: Boolean,
        quiz: Object,
    },
    data(){
        return {
            start: false,
            finished: false,
            timeRanOut: false,
            correct: 0,
            timer: 0,
            mode: "",
            score: 0,
            index: 0,
            currentQuestion: null,
            shuffledQuestions: this.quiz.questions.sort( () => Math.random() - 0.5),
        }
    },
    methods: {
        startQuiz(){
            this.start = true;

            this.shuffledQuestions = this.quiz.questions;

            this.index = Math.floor(Math.random() * this.shuffledQuestions.length);

            this.currentQuestion = this.shuffledQuestions[this.index];

            const startTimer = setInterval(() => {
                let time = this.timer;
                time--;
                this.timer = time;

                if(time === 0){
                    clearInterval(startTimer);
                    this.start = false;
                    this.finished = true;
                    this.timeRanOut = true;
                }
            }, 1000)
        },
        handleAnswer(type, answer){
            const classApply = answer === this.currentQuestion.answers[0].correct_answer ? 'correct' : 'incorrect';

            if(answer === this.currentQuestion.answers[0].correct_answer){
                this.score += 10;
                this.correct = this.correct + 1;
                this.$refs[type].classList.add(classApply);
            }else{
                this.$refs[type].classList.add(classApply);
            }

            setTimeout(() => {
                this.$refs[type]?.classList.remove(classApply);
            }, 150);

            this.shuffledQuestions.splice(this.index, 1);
            this.index = Math.floor(Math.random() * this.shuffledQuestions.length);
            this.currentQuestion = this.shuffledQuestions[this.index];

            if(this.shuffledQuestions.length === 0){
                this.start = false;
                this.finished = true;
            }
        },
        finishedQuiz(){
            window.location.reload();
        }
    }
}
</script>

<style scoped>
    .correct{
        background-color: green;
    }
    .incorrect{
        background-color: red;
    }
</style>