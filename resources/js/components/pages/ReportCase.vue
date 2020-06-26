<template>
    <div>
        <h3 class="text-center">Report Case</h3>
        <form-wrapper :validator="$v.form">
            <form @submit.prevent="submit" novalidate>
                <v-text-field v-model="form.fullName" placeholder="Your full name"
                              :counter="255" label="Full name" outlined
                                :class="{'danger': true}" :error="$v.form.fullName.$error"></v-text-field>
                <v-textarea v-model="form.contactInfo" placeholder="Your e-mail, phone number, address etc..."
                              :counter="255" label="Contact information" outlined
                            :class="{'danger': true}" :error="$v.form.contactInfo.$error"></v-textarea>
                <v-textarea v-model="form.caseReport" placeholder="Describe what happened in as much detail as you can"
                              label="Report" outlined :error="$v.form.caseReport.$error"></v-textarea>

                <base-errors v-bind="$attrs">
                    <v-alert dense type="error" class="mb-1" slot-scope="{errorMessage}"
                            border="bottom" color="red lighten-2">
                        <font-awesome-icon class="icon logo" :icon="['fa', 'exclamation-triangle']"></font-awesome-icon>
                        <span>{{errorMessage}}</span>
                    </v-alert>
                </base-errors>

                <v-btn type="submit" class="primary float-right">Submit</v-btn>
            </form>
        </form-wrapper>
        <case-assigned></case-assigned>
    </div>
</template>

<script>
    import {required, maxLength} from 'vuelidate/lib/validators';
    import {displayRequestErrorMessage, MODAL_TYPES} from "../../helpers";
    import CaseAssigned from "../modals/CaseAssigned";

    export default {
        components: {CaseAssigned},
        data() {
            return {
                form: {
                    fullName: '',
                    contactInfo: '',
                    caseReport: ''
                }
            }
        },
        methods: {
            async submit(){
                this.$v.form.$touch();
                if (this.$v.form.$pending || this.$v.form.$error) return;
                await this.postCaseReport().then((response) => {
                    if(response){
                        this.$modal.show(MODAL_TYPES.CASE_ASSIGNED, {
                            title: 'Your case was assigned to an officer!',
                            email: response.email,
                            name: response.name,
                            surname: response.surname
                        });
                    }
                });
            },
            async postCaseReport() {
                var vm = this;
                var postResponse = null;
                await axios.post(`api/case/report`, {
                    full_name: vm.form.fullName,
                    contact_info: vm.form.contactInfo,
                    case_report: vm.form.caseReport
                }).then((response) => {
                    postResponse = response.data;
                }).catch((data) => {
                    displayRequestErrorMessage(data.response);
                });

                return postResponse;
            }
        },
        validations() {
            return {
                form: {
                    fullName: {
                        required,
                        maxLength: maxLength(255)
                    },
                    contactInfo: {
                        required,
                        maxLength : maxLength(255)
                    },
                    caseReport: {
                        required
                    }
                }
            }
        }
    }
</script>
