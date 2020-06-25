import Vue from 'vue'
import Vuelidate from 'vuelidate';
import VuelidateErrorExtractor, {templates} from "vuelidate-error-extractor";
// Vue.config.productionTip = false;

Vue.use(Vuelidate);
Vue.use(VuelidateErrorExtractor, {
    messages: {
        required: "{attribute} field is required",
        maxLength: "{attribute} field needs to have less then {max} symbols"
    },
    attributes: {
        fullName: "Full name",
        contactInfo: "Contact information",
        caseReport: "Report"
    }
});

Vue.component("form-wrapper", templates.FormWrapper);
Vue.component("v-form-group", templates.singleErrorExtractor.foundation6);
Vue.component("base-errors", templates.multiErrorExtractor.baseMultiErrorExtractor);
