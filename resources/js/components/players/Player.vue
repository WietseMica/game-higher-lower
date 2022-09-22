<template>
    <div class="card">
        <div class="card-body text-center">
            <form>
                <h4>
                    <span v-if="inputPlayerNameisHidden">{{ playerName }} <button class="btn btn-sm btn-secondary"
                                                                                  v-on:click="inputPlayerNameisHidden = false">Edit</button></span>
                    <span v-if="!inputPlayerNameisHidden"><input class="form-control col-4" :name="playerKey"
                                                                 v-model="playerName"><button
                        class="btn btn-sm btn-success mt-2" v-on:click="savePlayerName(playerKey)">Save</button></span>
                </h4>
                <hr>
                <input class="form-control mb-3" :name="playerKey" v-model="playerGuessNumber">
                <span class="btn btn-primary" v-on:click="guessNumber">Guess Number</span>

                <div class="alert alert-danger mt-2" v-if="guessResultValue != null && guessResultValue !== 3">
                    <span v-if="guessResultValue === 1">HIGHER</span>
                    <span v-if="guessResultValue === 2">LOWER</span>
                </div>

            </form>
        </div>
    </div>

</template>

<script>
import axios from "axios";

export default {
    props: ['game', 'name', 'playerKey'],
    name: "Player",
    methods: {
        savePlayerName(playerKey) {
            this.inputPlayerNameisHidden = true;
            this.savePlayer(playerKey);
        },
        async savePlayer() {
            await axios.post('http://localhost/api/set-player-names', {
                playerKey: this.playerKey,
                name: this.playerName
            })
                .then(response => this.$toast.success(`Playername saved`))
                .catch(error => {
                    this.errorMessage = error.message;
                    this.$toast.error(error.message);
                });
        },
        async guessNumber() {
            await axios.post('http://localhost/api/guess-number', {
                number: this.playerGuessNumber
            })
                .then(response => this.guessResult(response.data.result))
                .catch(error => {
                    if (error.response !== undefined) {
                        this.$toast.error(error.response.data.errors.number);
                    }
                });
        },
        guessResult(result) {

            this.guessResultValue = result;

            if (this.guessResultValue === 3) {
                this.$emit('openWinnerModal', true);
            } else {
                this.$emit('openWinnerModal', false);
            }
        },
    },
    data() {
        return {
            guessResultValue: null,
            playerGuessNumber: null,
            playerName: this.name,
            inputPlayerNameisHidden: true,
        }
    }

}
</script>

<style scoped>

</style>
