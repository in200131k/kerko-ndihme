<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router } from '@inertiajs/vue3';
import { Inertia } from "@inertiajs/inertia";
import edit from "@/Pages/Questions/Edit.vue";
import Answers from "@/Components/Answers.vue";

export default {
    name: "View",
    components: {
        Answers,
        AuthenticatedLayout,
        Head,
        Link,
    },
    props: {
        question: Object,
    },
    data(){
        return {
            title: null,
            description: null,
            user_id: null,
        }
    },
    computed: {
        isMyQuestion() {
            if (this.$page.props.auth?.user) {
                return this.question.user_id === this.$page.props.auth.user.id;
            }
            return false;
        },
        edit() {
            return edit
        }
    },
    methods: {
        submit(){
            router.post(`/questions/${this.question.id}/answers`, {
                description: this.description,
            })
        },
        deleteQuestion(id) {
            Inertia.delete(route("question.destroy", id));
        },
        editQuestion(id) {
            router.visit(route('questions.edit', id), { method: 'get' })
        },
        upVote() {
            router.post(route('question-votes.up-vote', this.question.id));
        },
        downVote() {
            router.post(route('question-votes.down-vote', this.question.id));
        },
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-700/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg flex focus:outline focus:outline-2 focus:outline-red-500 gap-5"
                    >

                        <div class="flex flex-col gap-2">
                            <div
                                @click="upVote()"
                                class="h-16 w-16 p-5 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </div>

                            <div
                                class="h-16 w-16 p-5 border flex items-center justify-center rounded-full"
                            >
                                {{ question.score }}
                            </div>

                            <div
                                @click="downVote()"
                                class="h-16 w-16 p-5 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex flex-col justify-between w-full">
                            <div>
                                <div class="flex flex-row">
                                    <h2 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white mr-auto">{{ question.title }}</h2>

                                    <div class="flex flex-row gap-4 mt-2">
                                        <svg v-if="isMyQuestion" @click="deleteQuestion(question.id)" class="cursor-pointer transform hover:scale-105 hover:stroke-red-400 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>

                                        <svg v-if="isMyQuestion" @click="editQuestion(question.id)" class="cursor-pointer transform hover:scale-105 hover:stroke-red-400 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </div>

                                </div>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    {{ question.description }}
                                </p>
                            </div>

                            <div class="flex justify-between">
                                <div class="flex gap-6 items-center">
                                    <div class="flex gap-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 dark:text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>

                                        <span class="dark:text-white">{{ question.user.name }}</span>
                                    </div>

                                    <Link v-for="tag in question.tags" :key="tag.id" :href="route('tags.show', tag.id)" class="bg-gray-200 text-sm px-1 rounded dark:bg-gray-600 dark:text-gray-100">
                                        {{ tag.title }}
                                    </Link>
                                </div>
                            </div>

                        </div>
                    </div>

                    <Answers :question="question" />
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                        <form @submit.prevent="submit">
                            <label for="description">Description:</label>
                            <input id="description" v-model="description" />
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
