<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: "LinkQuestions",
    components: {
        Link,
    },
    props: {
        questions: Object
    }
}
</script>

<template>
    <Link v-for="question in questions" :key="question.id"
          :href="route('questions.show', question.id)"
          class="scale-100 p-6 bg-white dark:bg-gray-700/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 gap-5"
    >

        <div class="flex flex-col gap-2">
            <div class="h-16 w-16 p-5 bg-red-50 dark:bg-red-100/20 flex items-center justify-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            </div>

            <div class="h-16 w-16 p-5 border dark:border-gray-400 flex items-center justify-center rounded-full dark:text-white">
                {{ question.score }}
            </div>

            <div class="h-16 w-16 p-5 bg-red-50 dark:bg-red-100/20 flex items-center justify-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>

            <div class="relative mt-10 w-16 p-0 rounded-full flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
                <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold bg-blue-400 text-white border border-white rounded-full -top-3 right-1.5 dark:border-gray-200 dark:bg-blue-800">{{ question.answers.length }}</div>
            </div>

        </div>

        <div class="flex flex-col justify-between w-full mb-1">
            <div>
                <h2 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">{{ question.title }}</h2>
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

                    <div class="flex gap-2 items-center">
                        <span v-for="tag in question.tags" class="bg-gray-200 text-sm px-1 rounded dark:bg-gray-600 dark:text-gray-100">{{ tag.title }}</span>
                    </div>
                </div>
                <div class="flex">
                    <span class="dark:text-white">
                        Read more
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                    </svg>
                </div>
            </div>

        </div>
    </Link>
</template>

<style scoped>

</style>
