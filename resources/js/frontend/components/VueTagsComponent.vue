<template>
    <tags-input element-id="tags"
                v-model="selectedTags"
                :existing-tags="existingTags"
                :typeahead="true"
                :add-tags-on-space="true">
    </tags-input>
</template>

<script>

    export default {

        props: [
            'tags',
        ],
        data() {
            return {
                selectedTags: [],
                existingTags: this.tags,
            }
        },
        methods: {
            setSelectedTags(tags) {
                this.selectedTags = tags;
            },
            setExistingTag(response) {
                this.existingTags = response.existing_tags;
                // this.existingCategory = response.existing_categories;
            }
        }
    }

</script>
