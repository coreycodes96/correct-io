<template>
    <div>
        <!-- Create Quiz Button -->
        <div class="mt-10 mx-auto w-4/5 flex justify-end">
            <button @click="openQuiz" type="button" class="p-2 bg-green-500 text-white rounded">Create Quiz</button>
        </div>

        <!-- Create Quiz Modal -->
        <div ref="quizModal" class="mt-min-100 hidden fixed top-0 left-0 p-3 w-screen h-screen flex-col bg-gray-100 z-10">
           <div class="w-full h-8 flex justify-end">
                <i @click="closeQuiz" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <div class="mx-auto w-4/5 flex justify-between items-center">
                <button @click="type = 1, isQuestion = false" class="p-3 bg-green-500 text-white rounded">Quiz</button>
                <button @click="type = 2, isQuestion = false" class="p-3 bg-green-500 text-white rounded">Question List</button>
            </div>

            <div class="w-full h-full flex flex-col justify-center items-center overflow-y-scroll">
                <!-- Default -->
                <div v-if="type === 0">
                    <p class="text-3xl text-gray-700">Create a quiz</p>
                </div>
                
                <!-- Quiz -->
                <div v-if="!isQuestion && type === 1" class="mx-auto p-5 w-4/5 bg-white shadow-md shadow-gray-400">
                    <!-- Title -->
                    <div class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200" type="text" placeholder="Title..." v-model="title" />
                        <span class="italic text-red-500" v-if="quizErrors.title !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{quizErrors.title}}</span>
                    </div>

                    <!-- Description -->
                    <div class="mb-6 w-full">
                        <textarea class="mb-1 p-2 w-full h-24 placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200 resize-none" type="text" placeholder="Description..." v-model="description"></textarea>
                        <span class="italic text-red-500" v-if="quizErrors.description !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{quizErrors.description}}</span>
                    </div>
                    
                    <div class="mb-6 h-8 w-full">
                        <select v-model="category" class="w-full h-full outline-none border-b-2 border-green-500 text-black shadow-md">
                            <option value="">Pick A Category</option>
                            <option value="General">General</option>
                            <option value="Sport">Sport</option>
                            <option value="Maths">Maths</option>
                            <option value="English">English</option>
                            <option value="Science">Science</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Music">Music</option>
                            <option value="Movies">Movies</option>
                        </select>
                        <span class="italic text-red-500" v-if="quizErrors.category !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{quizErrors.category}}</span>
                    </div>

                    <button type="button" @click="isQuestion = true" class="mt-5 p-3 bg-green-500 text-white rounded">Add Question</button>

                    <template v-if="questions.length >= 5">
                        <button @click="createAQuiz" class="p-3 bg-green-500 text-white rounded">Create Quiz <i v-if="loading" class="fas fa-spinner mr-2 text-base animate-spin"></i></button>
                    </template>
                </div>

                <!-- Add Question -->
                <div v-if="isQuestion" class="mx-auto p-5 w-4/5 bg-white shadow-md shadow-gray-400 rounded">
                    <p class="mb-5 text-gray-700">You need atleast 5 questions to create a quiz. You are currently has {{questions.length}}</p>
                    <!-- Question -->
                    <div class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200" type="text" placeholder="Question..." v-model="question" />
                        <span class="italic text-red-500" v-if="questionErrors.question !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{questionErrors.question}}</span>
                    </div>

                    <!-- Answer 1 -->
                    <div class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200" type="text" placeholder="Answer 1..." v-model="answer1" />
                        <span class="italic text-red-500" v-if="questionErrors.answer1 !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{questionErrors.answer1}}</span>
                    </div>

                    <!-- Answer 2 -->
                    <div class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200" type="text" placeholder="Answer 2..." v-model="answer2" />
                        <span class="italic text-red-500" v-if="questionErrors.answer2 !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{questionErrors.answer2}}</span>
                    </div>

                    <!-- Answer 3 -->
                    <div v-if="addAnswer > 0" class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200" type="text" placeholder="Answer 3..." v-model="answer3"/>
                    </div>

                    <!-- Answer 4 -->
                    <div v-if="addAnswer > 1 && answer3" class="mb-6 w-full">
                        <input class="mb-1 p-2 w-full h-8 placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200" type="text" placeholder="Answer 4..." v-model="answer4"/>
                    </div>

                    <!-- Correct Answer -->
                    <div v-if="answer1 !== '' && answer2 !== ''" class="mb-6 w-full">
                        <select v-model="correct_answer" class="p-3 w-full placeholder:text-gray-700 outline-none border-b-2 border-green-500 shadow-md shadow-gray-200">
                            <option value="">Pick The Correct Answer</option>
                            <option :value="answer1">{{answer1}}</option>
                            <option :value="answer2">{{answer2}}</option>
                            <option v-if="answer3" :value="answer3">{{answer3}}</option>
                            <option v-if="answer4" :value="answer4">{{answer4}}</option>
                        </select>
                        <span class="italic text-red-500" v-if="questionErrors.correct_answer !== ''"><i class="fa-solid fa-circle-exclamation text-red-800 mr-2"></i>{{questionErrors.correct_answer}}</span>
                    </div>

                    <button v-if="addAnswer !== 2" type="button" @click="addAnswer = addAnswer + 1" class="mt-5 p-3 bg-green-500 text-white rounded">Add Another Answer</button>

                    <button v-if="question && answer1 && answer2 && correct_answer" type="button" @click="addQuestion" class="p-3 bg-green-500 text-white rounded">Add Question</button>
                </div>

                <!-- Question List -->
                <div v-if="type === 2" class="w-full">
                    <template v-if="questions.length === 0">
                        <p class="w-full text-2xl text-center text-gray-700">No questions have been added</p>
                    </template>

                    <template v-else>
                        <div class="mt-120"></div>
                        <div v-for="(q, idx) in questions" :key="'i'+idx" class="w-full">
                            <div class="my-10 mx-auto p-5 w-4/5 bg-white rounded shadow-xl shadow-gray-300">
                                <div class="w-full h-4 flex justify-end">
                                    <i @click="removeQuestion(idx)" class="fas fa-times cursor-pointer text-base"></i>
                                </div>
                                <p>Question: {{q.question}}</p>
                                <p>Answer 1: {{q.answer1}}</p>
                                <p>Answer 2: {{q.answer2}}</p>
                                <p v-if="q.answer3">Answer 3: {{q.answer3}}</p>
                                <p v-if="q.answer4">Answer 4: {{q.answer4}}</p>
                                <p>Correct Answer: {{q.correct_answer}}</p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    data(){
        return {
            type: 0,
            addAnswer: 0,
            isQuestion: false,
            title: "",
            description: "",
            category: "",
            question: "",
            answer1: "",
            answer2: "",
            answer3: null,
            answer4: null,
            correct_answer: "",
            quizErrors: {
                title: "",
                description: "",
                category: "",
            },
            questionErrors: {
                question: "",
                answer1: "",
                answer2: "",
                correct_answer: "",
            },
            questions: [],
            loading: false,
        }
    },
    methods: {
        ...mapActions('quiz', ['getQuizzes', 'createQuiz']),
        openQuiz(){
            tl.to(this.$refs.quizModal, {
                display: "flex",
                marginTop: "0",
                duration: 0.3,
                ease: "power3.out",
            });
        },
        closeQuiz(){
            tl.to(this.$refs.quizModal, {
                display: "flex",
                marginTop: "-100%",
                duration: 0.3,
                ease: "power3.out",
            });
        },
        addQuestion(){
            //Question Validation
            if(this.question === ''){
                this.questionErrors.question = 'Please enter a question';
            }else{
                this.questionErrors.question = '';
            }

            //Answer 1 Validation
            if(this.answer1 === ''){
                this.questionErrors.answer1 = 'Please enter a answer 1';
            }else{
                this.questionErrors.answer1 = '';
            }

            //Answer 2 Validation
            if(this.answer2 === ''){
                this.questionErrors.answer2 = 'Please enter a answer 2';
            }else{
                this.questionErrors.answer2 = '';
            }


            //Correct Answer Validation
            if(this.correct_answer === ''){
                this.questionErrors.correct_answer = 'Please select a correct answer';
            }else{
                this.questionErrors.correct_answer = '';
            }

            if(Object.values(this.questionErrors).includes('')){
                this.questions.push({
                    question: this.question,
                    answer1: this.answer1,
                    answer2: this.answer2,
                    answer3: this.answer3,
                    answer4: this.answer4,
                    correct_answer: this.correct_answer,
                });

                this.question = "";
                this.answer1 = "";
                this.answer2 = "";
                this.answer3 = null;
                this.answer4 = null;
                this.correct_answer = "";
                this.addAnswer = 0;
            }
        },
        removeQuestion(idx){
            this.questions.splice(idx, 1);
        },
        createAQuiz(){
            //Title Validation
            if(this.title === ''){
                this.quizErrors.title = 'Please enter a title.';
            }else{
                this.quizErrors.title = '';
            }

            //Description Validation
            if(this.description === ''){
                this.quizErrors.description = 'Please enter a description.';
            }else{
                this.quizErrors.description = '';
            }

            //Category Validation
            if(this.category === ''){
                this.quizErrors.category = 'Please enter a category.';
            }else{
                this.quizErrors.category = '';
            }

            //Questions Validation
            if(this.questions.length < 5){
                return;
            }

            if(Object.values(this.quizErrors).includes('')){
                this.loading = true;

                const data = {
                    title: this.title,
                    description: this.description,
                    category: this.category,
                    questions: this.questions
                };

                this.createQuiz(data)
                .then(res => {
                    this.getQuizzes();
                    this.loading = false;
                    this.closeQuiz();
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        }
    }
}
</script>