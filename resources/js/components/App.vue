<template>
    <div class="h-screen bg-white">
        <div class="flex">
            <div class="pl-6 bg-gray-200 w-48 h-screen border-r-2 border-gray-400">
                <nav class="pt-4">
                    <router-link to="/">Home</router-link>

                    <router-link to="/contacts/create" class="flex items-center py-2 hover:text-blue-600 text-sm">
                        <div class="tracking-wide pl-3">Add New</div>
                    </router-link>

                    <router-link to="/contacts" class="flex items-center py-2 hover:text-blue-600 text-sm">
                        <div class="tracking-wide pl-3">Contacts</div>
                    </router-link>

                    <router-link to="/logout" class="flex items-center py-2 hover:text-blue-600 text-sm">
                        <div class="tracking-wide pl-3">Logout</div>
                    </router-link>
                </nav>
            </div>
            <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
                <div class="h-16 px-6 border-b border-gray-400 flex items-center justify-between">
                    <div>
                        {{ title }}
                    </div>

                    <div class="flex items-center">
                        <SearchBar />
                        {{ user.name }}
                    </div>
                </div>

                <div class="flex flex-col overflow-y-hidden flex-1">
                    <router-view class="p-6 overflow-x-hidden"></router-view>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import SearchBar from '../components/SearchBar';

    export default {
        name: "App",

        props: [
            'user'
        ],

        components: {
            SearchBar
        },

        created() {
            this.title = this.$route.meta.title;

            window.axios.interceptors.request.use(
                (config) => {
                    if (config.method === 'get') {
                        config.url = config.url + '?api_token=' + this.user.api_token;
                    } else {
                        config.data = {
                            ...config.data,
                            api_token: this.user.api_token
                        };
                    }
                    return config;
                }
            )
        },

        data: function () {
            return {
                title: '',
            }
        },

        watch: {
            $route(to, from) {
                this.title = to.meta.title;
            },

            title() {
                document.title = this.title + ' | Laravel Vue Boilerplate'
            }
        }
    }
</script>

<style scoped>

</style>
