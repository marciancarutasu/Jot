<template>
    <div>
        <div v-for="contact in contacts">
            <router-link :to="'/contacts/' + contact.data.contact_id">
                <p> {{ contact.data.name }} </p>
                <p> {{ contact.data.company }} </p>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContactsList",
        components: {},
        props: [
            'endpoint',
        ],
        mounted() {
            axios.get(this.endpoint)
                .then(response => {
                    this.contacts = response.data.data;

                    this.loading = false;
                })
                .catch(error => {
                    this.loading = false;

                    alert('Unable to fetch contacts.');
                });
        },
        data: function () {
            return {
                loading: true,
                contacts: null,
            }
        }
    }
</script>
