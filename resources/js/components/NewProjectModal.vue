<template>
    <modal name="new-project-modal" classes="p-4 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's start something new</h1>

        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="mb-2 text-md block">Title</label>
                        <input class="input bg-transparent border rounded p-2 text-xs block w-full"
                               id="title"
                               type="text"
                               placeholder="My next awesome project"
                               :class="form.errors.title ? 'border-error' : 'border-gray-500'"
                               v-model="form.title"
                        >
                        <span
                            class="text-xs italic text-red-500"
                            v-if="form.errors.title"
                            v-text="form.errors.title[0]"
                        ></span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="mb-2 text-md block">Description</label>
                        <textarea
                            rows="10"
                            class="textarea bg-transparent border rounded p-2 text-xs w-full"
                            id="description"
                            placeholder="I should stop the birdshit"
                            :class="form.errors.description ? 'border-error' : 'border-gray-500'"
                            v-model="form.description"
                        ></textarea>
                        <span
                            class="text-xs italic text-red-500"
                            v-if="form.errors.description"
                            v-text="form.errors.description[0]"
                        ></span>
                    </div>
                </div>

                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="mb-2 text-md block">Need some tasks?</label>
                        <input class="input bg-transparent border border-gray-500 rounded p-2 text-xs block w-full mb-2"
                               id="task"
                               type="text"
                               placeholder="task 1"
                               v-for="task in form.tasks"
                               v-model="task.body"
                        >
                    </div>

                    <button type="button" @click="addTask" class="inline-flex items-center focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="mr-2">
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                                <path fill="#000" d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"></path>
                            </g>
                        </svg>

                        <span class="text-xs">Add new task field</span>
                    </button>

                </div>
            </div>
            <footer class="flex justify-end">
                <button type="button" class="button mr-8" @click="$modal.hide('new-project-modal')">
                    Cancel
                </button>

                <button class="button-blue">
                    Create Project
                </button>
            </footer>
        </form>



    </modal>
</template>

<script>
    import BirdShitForm from './BirdShitForm';

    export default {
        data() {
            return {
                form: new BirdShitForm({
                    title: '',
                    description: '',
                    tasks: [
                        { body: ''},
                    ],
                })
            };
        },

        methods: {
            addTask() {
                this.form.tasks.push({ body: '' });
            },

            async submit() {
                if (! this.form.tasks[0].body) {
                    delete this.form.originalData.tasks;
                }

                this.form.post('/projects')
                    .then(response => location = response.data.message);

                /*try {
                    location = (await axios.post('/projects', this.form)).data.message
                } catch(error) {
                    this.errors = error.response.data.errors;
                }*/

                /*axios.post('/projects', this.form)
                    .then(response => {
                        location = response.data.message;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });*/
            },
        }
    }
</script>
