<template>
    <ResourceDetail v-if="resource"
        :resource="resource"
        :value="model"
        :errors="errors"
        title="Edit"
        action="edit"
        @input="onInput" >

        <template slot="buttons">

            <a @click="onCancel"
                class="btn btn-blue" >
                Cancel
            </a>

            <a v-if="resource.policies.update"
                @click="onUpdate"
                class="btn btn-green" >
                Update
            </a>

        </template>

    </ResourceDetail>
</template>

<script>
import HasResource from './HasResource'

export default {
    mixins: [
        HasResource,
    ],

    computed: {
        source() {
            let resource = this.$route.params.resource
            let resourceKey = this.$route.params.resourceKey

            return `/api/resources/${resource}/${resourceKey}/edit`
        }
    },

    methods: {
        async onUpdate() {
            let response = await this.$put(`/api/resources/${this.resource.name}/${this.resource.key}`, this.model)

            if (response.status == 'success') {
                this.$router.go(-1)
            } else {
                this.errors = response.errors
            }
        },

        onCancel() {
            this.$router.go(-1)
        },
    }
}
</script>
