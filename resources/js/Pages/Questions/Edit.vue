<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
export default {
    name: "Edit",
    components: {
        AuthenticatedLayout,
        Head,
    },
    props: {
      question: Object,
    },
    data(){
        return {
            title: this.question.title || null,
            description: this.question.description || null,
        }
    },
    methods: {
        submit(){
            router.put(`/questions/${this.question.id}`, {
                title: this.title,
                description: this.description,
            })
        }
    },
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
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8" v-if="question">
                    <form @submit.prevent="submit">
                        <label for="title">Title:</label>
                        <input id="title" v-model="title" />
                        <label for="description">Description:</label>
                        <input id="description" v-model="description" />
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
