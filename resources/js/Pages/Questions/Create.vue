<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
export default {
    name: "View",
    components: {
        AuthenticatedLayout,
        Head,
    },
    data(){
        return {
            title: null,
            description: null,
            user_id: null,
        }
    },
    methods: {
        submit(){
            router.post('/questions/', {
                title: this.title,
                description: this.description,
                user_id: this.user_id,
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
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <form @submit.prevent="submit">
                        <label for="title">Title:</label>
                        <input id="title" v-model="title" />
                        <label for="description">Description:</label>
                        <input id="description" v-model="description" />
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
