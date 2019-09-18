<template>
    <div class="hello">
        <ul>
            <li v-for="question in questions">{{ question.title }}</li>
        </ul>
        <create-question-card :job="job"></create-question-card>
    </div>
</template>

<script>
    export default {
        props: ['job'],

        data() {
            return {
                questions: this.job.questions,
            }
        },

        mounted() {
            Event.listen('question-was-added', (data) => {
                console.log('adding question to question list');
                this.questions.push(data);
            });
        },
    }
</script>

<style scoped>

</style>
