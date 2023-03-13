<script>
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";

export default {
    name: "CreateQuestionModal",
    components: {PrimaryButton, SecondaryButton, InputError, TextInput, InputLabel, Modal},
    data() {
        return {
            confirmingUserDeletion: false,
            form: useForm({
                title: null,
                description: null,
            }),
        }
    },
    methods: {
        confirmUserDeletion() {
            this.confirmingUserDeletion = true;
        },
        createQuestion() {
            this.form.post(route('questions.store'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.form.title.focus(),
                onFinish: () => this.form.reset(),
            });
        },
        closeModal() {
            this.confirmingUserDeletion = false;

            this.form.reset();
        }
    }
}
</script>

<template>
    <SecondaryButton @click="confirmUserDeletion">Create New Question</SecondaryButton>
    <Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create new question
            </h2>

            <div class="mt-6">
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Title"
                    @keyup.enter="createQuestion"
                />

                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <div class="mt-6">
                <InputLabel for="description" value="Description" />

                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Description"
                    @keyup.enter="createQuestion"
                />

                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="createQuestion"
                >
                    Create New Question
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<style scoped>

</style>
