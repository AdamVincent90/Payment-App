<template>
    <div class="d-flex pr-5">
        <i class="fas fa-star text-warning fa-sm" v-for="star in fullStar" :key="'full' + star"></i>
        <i class="fas fa-star-half-alt text-warning fa-sm" v-if="halfStar"></i>
        <i class="fas fa-star text-dark fa-sm" v-for="star in emptyStar" :key="'empty' + star"></i>
    </div>
</template>

<script>
export default {
    props: {
        rating: [Number, String]
    },
    computed: {
        fullStar() {
            return Math.round(this.rating);
        },
        emptyStar() {
            return 5 - Math.ceil(this.rating);
        },
        halfStar() {
            const decimal = (this.rating - Math.floor(this.rating)) * 100;
            
            return decimal > 0 && decimal < 50;
        }
    }
}
</script>