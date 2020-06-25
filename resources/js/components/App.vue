<template>
    <v-app>
        <div class="container app-container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="navbar-nav m-auto">
                    <router-link to="/" class="nav-item nav-link d-flex">
                        <font-awesome-icon class="icon logo" :icon="['fa', 'biking']"></font-awesome-icon>
                        <span class="m-auto logo-label">Its Mr.StealYourBike</span>
                    </router-link>
                </div>
            </nav>
            <br/>
            <div class="app-body">
                <router-view></router-view>
                <notifications></notifications>
            </div>
        </div>
    </v-app>
</template>

<script>
    export default {}
</script>
