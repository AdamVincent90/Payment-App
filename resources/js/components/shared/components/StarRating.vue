<template>
    <div class="d-flex pr-5">
        <i
            class="fas fa-star text-warning fa-sm"
            v-for="star in fullStar"
            :key="'full' + star"
            @click="$emit('input', star)"
        ></i>
        <i class="fas fa-star-half-alt text-warning fa-sm" v-if="halfStar"></i>
        <i
            class="fas fa-star text-dark fa-sm"
            v-for="star in emptyStar"
            :key="'empty' + star"
            @click="$emit('input', fullStar + star)"
        ></i>
    </div>
</template>

<script>
export default {
    props: {
        value: [Number, String]
    },
    computed: {
        fullStar() {
            return Math.round(this.value);
        },
        emptyStar() {
            return 5 - Math.ceil(this.value);
        },
        halfStar() {
            const decimal = (this.value - Math.floor(this.value)) * 10;

            return decimal > 0 && decimal < 5;
        }
    }
};
</script>
