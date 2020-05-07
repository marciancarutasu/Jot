<template>
    <div>
        <div v-if="focus" @click="focus = false"></div>

        <div>
            <input type="text" id="searchTerm" v-model="searchTerm" @input="search" @focus="focus = true">

            <div v-if="focus">
                <div v-if="results == 0">No results found for '{{ searchTerm }}'</div>
                <div v-for="result in results" @click="focus = false">
                    <router-link :to="result.links.self" class="block py-2">
                        <div>
                            <p>{{ result.data.name }}</p>
                            <p>{{ result.data.company }}</p>
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
