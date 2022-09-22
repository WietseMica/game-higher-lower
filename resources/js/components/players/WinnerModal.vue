<template>

    <div id="myModal" class="modal" :style="showOrHide === true ? 'display: block' : 'display: none'">

        <div class="modal-content">
            <span class="close" v-on:click="closeModal">&times;</span>
            <h1 class="text-center text-uppercase">You win</h1>
            <img :src="image" class="firework-img" alt="Fireworks"/>
        </div>

    </div>

</template>

<script>

import FireWorks from '/storage/app/public/firworks.jpeg';

export default {
    props: ['showOrHide'],
    name: "WinnerModal",
    methods: {
        closeModal() {
            //Maybe not the best solution
            document.getElementById("myModal").style.display = "none";
            window.location.reload();
        }
    },
    data() {
        return {
            image: FireWorks
        }
    }
}
</script>

<style scoped>

</style>
