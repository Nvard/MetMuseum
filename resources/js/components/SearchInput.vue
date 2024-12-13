<template>
    <div class="input-group">
        <input
            type="text"
            class="form-control"
            v-model="query"
            placeholder="Search artworks..."
        />
        <button
            class="btn btn-primary search-btn"
            @click="onSearch"
            :disabled="loading || !isDepartmentLoaded || !query"
        >
            <i class="bi bi-search"></i>
            <span v-if="loading">Searching...</span>
            <span v-else>Search</span>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            isDepartmentLoaded: {
                type: Boolean,
                required: true,
            },
            loading: {
                type: Boolean,
                required: true,
            },
        },
        data() {
            return {
                query: '',
            };
        },
        methods: {
            async onSearch() {
                if (this.loading) return; // Prevent further clicks while loading
                this.$emit('search', this.query);  // Emit search event with the query
            },
        },
    };
</script>

<style scoped>

</style>
