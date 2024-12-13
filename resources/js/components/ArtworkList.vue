<template>
    <div class="container mt-5">
        <div class="row">
            <div v-for="artwork in artworks" :key="artwork.objectID" class="col-md-4 mb-4">
                <div class="card shadow-sm d-flex">
                    <!-- Artwork Image with Fallback -->
                    <img
                        :src="artwork.primaryImage || 'https://via.placeholder.com/200'"
                        class="card-img-left"
                        :alt="artwork.title"
                    />
                    <!-- Card Body (Title and Artist) -->
                    <div class="card-body d-flex flex-column justify-content-center">
                        <!-- Title -->
                        <h5 class="card-title text-truncate">{{ artwork.title }}</h5>
                        <!-- Artist Prefix -->
                        <p class="card-text text-muted">{{ artwork.artistPrefix }} {{ artwork.artistDisplayName }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['artworks'],
    };
</script>

<style scoped>
    .card {
        display: flex;
        flex-direction: row; /* Aligns the image and text horizontally */
        align-items: center;
    }

    .card-img-left {
        width: 200px; /* Keeps image size fixed */
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 1rem;
        flex: 1; /* Take up remaining space for the text */
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .container {
        margin-top: 30px;
    }
</style>
