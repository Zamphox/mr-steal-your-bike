<template>
    <div>
        <modal :name="MODAL_TYPES.OFFICER_STATUS" adaptive scrollable width="750px" height="auto"
               @before-open="initProps">
            <v-card class="mx-auto pt-3 pb-3 no-border" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <div class="overline mb-2">{{params.case ? 'You have a case!' : 'You have no cases'}}</div>
                        <v-list-item-title class="headline mb-1">Officer {{params.name}} {{params.surname}}</v-list-item-title>
                        <div class="grey--text text-darken-1 mb-2" v-if="params.case">{{params.case.reported_by}}<br>{{params.case.contact}}</div>
                        <v-list-item-subtitle class="d-block">{{params.case ? params.case.body : 'Have a break!'}}</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar tile size="125" class="m-auto mt-1 mb-1 rounded-sm shadow">
                        <img :src="'https://api.adorable.io/avatars/285/' + params.email">
                    </v-list-item-avatar>
                </v-list-item>
                <v-btn v-if="params.case" class="primary float-right m-2 mt-0" @click="closeCase(params.case.id)">Close case</v-btn>
            </v-card>
        </modal>
    </div>
</template>

<script>
    import {displayRequestErrorMessage, MODAL_TYPES} from "../../helpers";

    export default {
        name: 'OfficerStatus',
        data() {
            return {
                MODAL_TYPES,
                params: {}
            }
        },
        methods: {
            initProps(event){
                this.params = event.params;
            },
            async closeCase(id) {
                var vm = this;
                await axios.post(`api/case/close/` + id).then(() => {
                    vm.$modal.hide(MODAL_TYPES.OFFICER_STATUS);
                }).catch((data) => {
                    displayRequestErrorMessage(data.response);
                });
            }
        }
    }
</script>
