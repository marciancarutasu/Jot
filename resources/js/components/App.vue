<template>
    <div>
        <nav>
            <router-link to="/">
                <div>Home</div>
            </router-link>

            <router-link to="/contacts/create">
                <div>Add New</div>
            </router-link>

            <router-link to="/contacts">
                <div>Contacts</div>
            </router-link>

            <router-link to="/logout">
                <div>Logout</div>
            </router-link>
        </nav>
        <div>
            <div>
                <div>
                    {{ title }}
                </div>

                <div>
                    <SearchBar />
                    {{ user.name }}
                </div>
            </div>

            <div>
                <router-view></router-view>
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
            // SearchBar
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
