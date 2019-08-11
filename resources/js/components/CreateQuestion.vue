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
                        <input id="title" type="text" class="form-control" name="title" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <textarea id="description" name="description" class="form-control"></textarea>
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
        methods: {
            submitForm: function() {
                alert('submitting form');
            }
        }
    }
</script>

<style scoped>

</style>
