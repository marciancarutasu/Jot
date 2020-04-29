<template>
    <div>
        <form @submit.prevent="submitForm">
            <label for="name">Contact name</label>
            <InputField name="name" :errors="errors"
            placeholder="Contact Name" @update:field="form.name = $event" />

            <label for="email">Contact Email</label>
            <InputField name="email" :errors="errors"
            placeholder="Contact Email" @update:field="form.email = $event" />

            <label for="company">Company</label>
            <InputField name="company":errors="errors"
            placeholder="Company" @update:field="form.company = $event" />

            <label for="birthday">Birthday</label>
            <InputField name="birthday" :errors="errors"
            placeholder="MM/DD/YYYY" @update:field="form.birthday = $event" />

            <div>
                <button>Cancel</button>
                <button>Add New Contact</button>
            </div>
        </form>
    </div>
</template>

<script>
    import InputField from '../components/InputField';

    export default {
        name: "ContactsCreate",

        components: {
            InputField
        },

        data: function () {
            return {
                form: {
                    'name': '',
                    'email': '',
                    'company': '',
                    'birthday': '',
                },

                errors: null,
            }
        },

        methods: {
            submitForm: function () {
                axios.post('/api/contacts', this.form)
                    .then(response => {
                        this.$router.push(response.data.links.self);
                    })
                    .catch(errors => {
                        this.errors = errors.response.data.errors;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
