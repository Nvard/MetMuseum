<template>
    <div id="app">
        <!-- Main Wrapper with Background Image and Overlay -->
        <div class="background-wrapper position-relative">
            <!-- Overlay with opacity to darken the image -->
            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>

            <!-- Title Section -->
            <div class="title-container position-absolute top-50 start-50 translate-middle text-center text-white z-index-2 p-5">
                <h1 class="display-3 font-weight-bold text-shadow">The Metropolitan Museum of Art </h1>
            </div>

            <!-- Dropdown and Search Form -->
            <div class="form-container position-absolute top-50 start-50 translate-middle-x text-center z-index-2">
                <!-- Department Dropdown and Search Input in one line -->
                <div class="d-flex justify-content-center gap-3 mb-3">
                    <div class="mb-3">
                        <DepartmentDropdown :departments="departments" @select="selectDepartment" />
                    </div>
                    <div class="mb-3">
                        <SearchInput
                            :isDepartmentLoaded="isDepartmentLoaded"
                            :loading="loading"
                            @search="performSearch"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Below the Image Background -->
        <div class="container mt-5">
            <!-- Artwork List -->
            <div v-if="artworks.length" class="mt-4">
                <ArtworkList :artworks="artworks" />
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import DepartmentDropdown from './components/DepartmentDropdown.vue';
    import SearchInput from './components/SearchInput.vue';
    import ArtworkList from './components/ArtworkList.vue';

    export default {
        components: {
            DepartmentDropdown,
            SearchInput,
            ArtworkList,
        },
        data() {
            return {
                departments: [],
                selectedDepartment: null,
                artworks: [],
                loading: false,  // Track the loading state of search
                isDepartmentLoaded: false,  // Track department loading state
            };
        },
        methods: {
            async fetchDepartments() {
                this.isDepartmentLoaded = false;  // Mark departments as not loaded
                const response = await axios.get('/departments');
                this.departments = response.data.departments;
                this.isDepartmentLoaded = true;  // Mark departments as loaded
            },
            selectDepartment(departmentId) {
                this.selectedDepartment = departmentId;
            },
            async performSearch(query) {
                if (!query) return;
                this.isDepartmentLoaded = false;  // Mark departments as not loaded
                const response = await axios.get('/search', {
                    params: {
                        departmentId: this.selectedDepartment,
                        query,
                    },
                });
                this.artworks = response.data;
                this.isDepartmentLoaded = true;  // Mark departments as loaded
            },
        },
        mounted() {
            this.fetchDepartments();
        },
    };
</script>

