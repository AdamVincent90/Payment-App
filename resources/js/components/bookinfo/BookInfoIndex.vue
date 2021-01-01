<template>
    <div class="row">
            <div class="col-lg-8 col-sm-12 pb-2">
                <div v-if="loading" class="spinner-border text-primary" role="status"></div>
                <div v-else class="card">
                    <div class="card-header">
                        <h3>{{book.book_title}}</h3>
                    </div>
                    <div class="card-body">
                        <strong>Written by {{book.author}}</strong>
                        <article>{{book.description}}</article>
                    </div>
                    <div class="card-footer col-12 text-center bg-white">
                        <strong class="pb-1">Buy now for £{{book.price}}.99</strong>
                        <p>Date released: {{book.release_date}}</p>
                    </div>
                </div>
            </div>
            <review-list :book_id="this.$route.params.id"></review-list>
        </div> 
</template>

<script>

// import CheckStock from "./CheckStock";
import ReviewList from "./ReviewList";

export default {
    data() {
        return {
        book: null,
        loading: false
        }
    },
    components: {
        ReviewList
    },
    created() {
        
        this.loading = true;

        axios.get(`/api/books/${this.$route.params.id}`)
        .then(response => {
            this.book = response.data;
            this.loading = false;
        });
    }
}
</script>