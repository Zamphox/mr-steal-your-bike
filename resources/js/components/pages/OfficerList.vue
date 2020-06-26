<template>
    <div class="row text-center d-flex" ref="officer_list_container" style="overflow: auto; height: 100vh">
        <v-list :three-line="true" class="w-75 m-auto mt-0">
            <h3 class="text-center">Who are you?</h3>
            <v-text-field label="Search" v-model="searchQuery" @input="debounceAddNextPageOfficers"></v-text-field>
            <v-list-item-group v-if="officers.length">
                <v-list-item v-for="(officer, i) in officers" :key="i" @click="getOfficerStatus(officer.id)">
                    <v-list-item-avatar>
                        <v-img :src="'https://api.adorable.io/avatars/285/' + officer.email"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{officer.name + ' ' + officer.surname}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
            <div v-else>No officers found!</div>
            <div ref="scroll_bottom_trigger"></div>
        </v-list>
        <officer-status></officer-status>
    </div>
</template>

<script>
    import {displayRequestErrorMessage, MODAL_TYPES} from "../../helpers";
    import OfficerStatus from "../modals/OfficerStatus";

    export default {
        components: {OfficerStatus},
        data() {
            return {
                officers: [],
                loading: false,
                next_page_url: 'api/officers',
                searchQuery: '',
                currentPage: 0
            }
        },
        mounted: function () {
            var vm = this
            vm.$refs.officer_list_container.addEventListener('scroll', () => {
                if(vm.officers.length) {
                    if (vm.isScrolledIntoView(vm.$refs.scroll_bottom_trigger)) {
                        if (vm.next_page_url && !vm.loading) {
                            vm.addNextPageOfficers();
                        }
                    }
                }
            }, false)

            vm.addNextPageOfficers();
        },
        methods: {
            isScrolledIntoView(elem) {
                var $elem = $(elem);
                var $window = $(window);

                var docViewTop = $window.scrollTop();
                var docViewBottom = docViewTop + $window.height();
                var elemTop = $elem.offset().top;
                var elemBottom = elemTop + $elem.height();

                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            },
            debounceAddNextPageOfficers() {
                var vm = this;
                var debounce = _.debounce(function(){vm.addNextPageOfficers()}, 1000)

                vm.next_page_url = 'api/officers';
                vm.currentPage = 0;
                debounce();
            },
            async addNextPageOfficers() {
                var vm = this;
                if(vm.next_page_url){
                    vm.loading = true;
                    console.log(vm.cur)
                    vm.currentPage < 1 ? vm.officers = [] : '';
                    await axios.get(vm.next_page_url, {
                        params: {
                            s: vm.searchQuery,
                            page: vm.currentPage + 1
                        }
                    }).then(response => {
                        var data = response.data;

                        vm.currentPage = data.current_page;
                        vm.next_page_url = data.next_page_url;
                        data.data.forEach((officer) => {
                            vm.officers.push(officer);
                        });
                        vm.loading = false;
                    }).catch((data) => {displayRequestErrorMessage(data.response);vm.loading = false;})
                }
            },
            async getOfficerStatus(id) {
                var vm = this;
                await axios.get('/api/officers/status/' + id).then(response => {
                    var data = response.data;
                    this.$modal.show(MODAL_TYPES.OFFICER_STATUS, {
                        name: data.name,
                        surname: data.surname,
                        email: data.email,
                        case: data.case
                    });
                }).catch((data) => {displayRequestErrorMessage(data.response);vm.loading = false;})
            },
        }
    }
</script>
