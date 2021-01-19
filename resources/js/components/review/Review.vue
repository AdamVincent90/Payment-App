<template>
    <div class=" row">
        <div
            :class="[
                { 'col-md-4': loading || !alreadyReviewed },
                { 'd-none': !loading && alreadyReviewed }
            ]"
        >
        <div v-if="loading">Loading...</div>
            <div class="card" v-else>
                <div class="card-body">
                    <div class="card-title">
                        <h6 class="text-primary">{{ book.book_title }}</h6>
                    </div>
                    <strong class="text-center">{{ book.author }}</strong>
                    <p class="text-dark">{{ book.description }}</p>
                    <div class="card-footer">
                        <router-link :to="{name: 'book', params: {id: book.book_id}}">View Book</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div
            :class="[
                { 'col-md-8': loading || !alreadyReviewed },
                { 'col-md-12': !loading && alreadyReviewed }
            ]"
        >
            <div
                v-if="loading"
                class="spinner-border text-primary"
                role="status"
            ></div>
            <div v-else>
                <div v-if="alreadyReviewed" class="text-center">
                    A review already exists!
                </div>
                <div v-else>
                    <div class="form-group">
                        <label class="text-muted"
                            >What do you rate this book?</label
                        >
                        <star-rating
                            v-model="review.rating"
                            class="fa-2x"
                        ></star-rating>
                    </div>
                    <div class="form-group">
                        <label for="content" class="text-muted"
                            >Write your review</label
                        >
                        <textarea
                            name="content"
                            cols="10"
                            rows="10"
                            class="form-control"
                            v-model="review.content"
                        ></textarea>
                        <button class="btn btn-lg btn-primary btn-block">
                            Submit Review
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            review: {
                rating: 5,
                content: null
            },
            reviewFlag: null,
            errors: null,
            loading: false,
            book: {
                book_id: null,
                book_title: null,
                author: null,
                description: null
            }
        };
    },
    async created() {
        try {
            this.loading = true;

            const req = await axios.get(
                `/api/reviews/${this.$route.params.id}`
            );

            if (req) {
                this.reviewFlag = req.data.data;
                this.loading = false;
            }
        } catch (error) {
            if (
                error.response &&
                error.response.status &&
                404 === error.response.status
            ) {
                axios
                    .get(`/api/book-by-review/${this.$route.params.id}`)
                    .then(res => (this.book = res.data.data))
                    .then((this.loading = false));
            }
        }
    },
    computed: {
        alreadyReviewed() {
            return this.reviewFlag !== null;
        },
        hasReview() {}
    }
};
</script>
