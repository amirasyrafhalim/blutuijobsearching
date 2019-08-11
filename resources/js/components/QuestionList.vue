<template>
    <div class="hello">
        <ul>
            <li v-for="question in questions">{{ question.title }}</li>
        </ul>
        <create-question-card></create-question-card>
    </div>
</template>

<script>
    export default {
        props: ['questions']
    }
</script>

<style scoped>

</style>
