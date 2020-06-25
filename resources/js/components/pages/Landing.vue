<template>
    <div>
        <div class="row text-center d-flex landing">
            <div class="site-info d-flex flex-column mb-3">
                <span class="h2">Did someone steal your bike?</span>
                <span class="h3">Your bike is more than a tool. It’s a companion that makes you feel more alive and connected to the world, whether for a short dash to the store or an all-day excursion.
                    Your bike is an extension of yourself, and having it taken away is an emotional loss.
                    <br>And we are here to help you.
                </span>
            </div>
            <div class="m-auto row w-75 mt-1">
                <v-btn to="/report-case" large class="deep-orange white--text landing-btn m-auto mt-2">I'd like to report a crime</v-btn>
                <v-btn to="/report-case" large class="primary landing-btn m-auto mt-2">I am an officer</v-btn>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>
