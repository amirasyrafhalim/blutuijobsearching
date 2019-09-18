<template>
    <div>
        <div class="card">
            <div class="card-header">
                Create new Question
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" v-model="title" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <textarea id="description" name="description" class="form-control" v-model="description"></textarea>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" @click="submitForm">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['job'],

        data() {
            return {
                title: "",
                description: "",
            }
        },

        methods: {
            submitForm: function() {
                axios.post(`/jobs/${this.job.slug}/questions`, {
                    'title': this.title,
                    'description': this.description
                }).then(response => {
                    Event.fire('question-was-added', response.data);
                    this.title = '';
                    this.description = '';
                }).catch(error => {
                    console.log(error.message)
                });
            }
        }
    }
</script>

<style scoped>

</style>
