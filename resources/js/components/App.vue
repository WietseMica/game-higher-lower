<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 text-center mb-5">
                <h1>Guess the Number</h1>
                <h2>The greatest guessing game ever guessed</h2>
            </div>

            <div class="col-12 button-bar">

                <button class="btn btn-primary float-end mb-3">Start New Game</button>
            </div>

            <div class="mt-5">
                <players></players>
            </div>
        </div>
    </div>
</template>

<script>

import Players from './players/Players.vue'

export default {
    name: "App",
    components: {
        Players
    },
    data() {
        return {
            game: []
        }
    }
}
</script>

<style scoped>

</style>
