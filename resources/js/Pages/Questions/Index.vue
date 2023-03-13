<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LinkQuestions from "@/Components/LinkQuestions.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import CreateQuestionForm from "@/Pages/Questions/Partials/CreateQuestionForm.vue";

export default {
    components: {
        CreateQuestionForm,
        Modal,
        DangerButton,
        LinkQuestions,
        AuthenticatedLayout,
        Head,
        Link,
    },
    props: {
        questions: Object,
    },
    data() {
        return {
            form: useForm({
                title: null,
                description: null,
            }),
        }
    },
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Questions</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row justify-end mb-6">
                    <CreateQuestionForm />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <LinkQuestions :questions="questions" />
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
