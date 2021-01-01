<template>
    <div class="container">
        <h5 class="pt-2 text-uppercase text-primary font-weight-bolder">
            Reviews
        </h5>
        <div
            v-if="loading"
            class="spinner-border text-primary"
            role="status"
        ></div>
        <div
            v-else
            class="border-bottom border-primary pb-3 pt-2 bg-light"
            v-for="(review, index) in this.reviews"
            :key="index"
        >
            <div class="row pb-1">
                <div class="col-md-6 font-weight-bolder">
                    {{ review.created_at | fromNow }}
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <star-rating :rating="review.rating"></star-rating>
                </div>
            </div>
            <div class="row pb-1">
                <div class="col-md-12">
                    {{ review.name }}
                </div>
            </div>
            <div class="row font-italic">
                <div class="col-md-12">
                    {{ review.content }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    props: {
        book_id: [String, Number]
    },
    data() {
        return {
            loading: false,
            reviews: null
        };
    },
    created() {
        this.loading = true;

        const request = axios
            .get(`/api/books/${this.book_id}/reviews`)
            .then(response => {
                this.reviews = response.data.data;
                console.log(response);
                this.loading = false;
            })
            .catch(error => console.log(error));
    },
    filters: {
        fromNow(value) {
            return moment(value).fromNow();
        }
    }
};
</script>

<style scoped></style>