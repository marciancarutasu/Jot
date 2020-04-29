<template>
    <div>
        <div v-if="focus" @click="focus = false"></div>

        <div class="relative z-10">
            <input type="text" class="w-64 mr-6 bg-gray-200 border border-gray-400 pl-8 pr-3 py-1 rounded-full text-sm focus:outline-none focus:border-blue-500 focus:shadow focus:bg-gray-100" placeholder="Search..." id="searchTerm" v-model="searchTerm" @input="search" @focus="focus = true">

            <div v-if="focus" class="absolute bg-blue-900 text-white rounded-lg p-4 w-96 right-0 mr-6 mt-2 shadow z-20">
                <div v-if="results == 0">No results found for '{{ searchTerm }}'</div>
                <div v-for="result in results" @click="focus = false">
                    <router-link :to="result.links.self" class="block py-2">
                        <div class="flex items-center">

                            <div class="pl-3">
                                <p>{{ result.data.name }}</p>
                                <p>{{ result.data.company }}</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import _ from 'lodash';

    export default {
        name: "SearchBar",

        components: {
        },

        data: function () {
            return {
                searchTerm: '',
                focus: false,
                results: []
            }
        },

        methods: {
            search: _.debounce(function (e) {
                if (this.searchTerm.length < 3) {
                    return;
                }

                axios.post('/api/search', {searchTerm: this.searchTerm})
                    .then(response => {
                        this.results = response.data.data;
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            }, 300)
        }
    }
</script>

<style scoped>

</style>
