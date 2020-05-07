<template>
    <div>
        <a href="#" @click="$router.back()">
            Back
        </a>
        <div class="relative">
            <router-link :to="'/contacts/' + contact.contact_id + '/edit'">Edit</router-link>
            <a href="#" @click="modal = ! modal">Delete</a>

            <div v-if="modal">
                <p>Are you sure you want to delete this record?</p>

                <div>
                    <button @click="modal = ! modal">Cancel</button>
                    <button @click="destroy">Delete</button>
                </div>
            </div>
        </div>
        <div v-if="modal" @click="modal = ! modal"></div>

        <p>{{ contact.name }}</p>

        <p>Contact</p>
        <p>{{ contact.email }}</p>

        <p>Company</p>
        <p>{{ contact.company }}</p>

        <p>Birthday</p>
        <p>{{ contact.birthday }}</p>

    </div>
</template>

<script>

    export default {
        name: "ContactsShow",

        components: {
        },

        mounted() {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(response => {
                    this.contact = response.data.data;

                    this.loading = false;
                })
                .catch(error => {
                    this.loading = false;

                    if (error.response.status === 404) {
                        this.$router.push('/contacts');
                    }
                });
        },

        data: function () {
            return {
                loading: true,
                modal: false,
                contact: null,
            }
        },

        methods: {
            destroy: function () {
                axios.delete('/api/contacts/' + this.$route.params.id)
                    .then(response => {
                        this.$router.push('/contacts');
                    })
                    .catch(error => {
                        alert('Internal Error. Unable to delete contact.');
                    });
            }
        }
    }
</script>
