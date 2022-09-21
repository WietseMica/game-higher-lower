<template>
    <div class="alert alert-danger m-5" v-if="errorMessage != null">
        {{errorMessage}}
    </div>

    <div class="row">
        <div v-for="(player, key) in game.players" :key="key">
            <player :name="player" :playerKey="key" :game="game"></player>
        </div>
    </div>
</template>

<script>

import Player from "./Player.vue";
import axios from "axios";

export default {
    name: "Players",
    components: {
        Player
    },
    methods: {
        async loadGame() {
            await axios.get('http://localhost/api/start-game')
                .then(response => this.game = response.data.game)
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was an error!", error);
                });
        }
    },
    async mounted() {
        await this.loadGame();
    },
    data() {
        return {
            errorMessage: null,
            game: {
                id: null,
                players: [],
                randomNumber: null,
            },
        }
    }
}
</script>

<style scoped>

</style>
