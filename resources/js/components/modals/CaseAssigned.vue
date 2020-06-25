<template>
    <div>
        <modal :name="MODAL_TYPES.CASE_ASSIGNED" adaptive scrollable height="auto"
               @before-open="initProps" @before-close="$router.push('/');">
            <v-card class="mx-auto pt-3 pb-3" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <div class="overline mb-2">{{params.title}}</div>
                        <v-list-item-title class="headline mb-1">Officer {{params.name}} {{params.surname}}</v-list-item-title>
                        <div class="grey--text text-darken-1 mb-2">
                            {{params.email}}
                        </div>
                        <v-list-item-subtitle>You will be contacted as as soon as possible!</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar tile size="125" class="m-auto rounded-sm shadow">
                        <img :src="'https://api.adorable.io/avatars/285/' + params.email">
                    </v-list-item-avatar>
                </v-list-item>
            </v-card>
        </modal>
    </div>
</template>

<script>
    import {MODAL_TYPES} from "../../helpers";

    export default {
        name: 'CaseAssigned',
        props: ['title', 'officer'],
        data() {
            return {
                MODAL_TYPES,
                params: {}
            }
        },
        methods: {
            initProps(event){
                this.params = event.params;
            }
        }
    }
</script>
