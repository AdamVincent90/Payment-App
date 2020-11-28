<template>
    <div>
        PAYMENT COMPLETE
        <div
            v-if="loading"
            class="spinner-border text-primary"
            role="status"
        ></div>
        <div v-else class="container">
            <p>{{ resultCode }}</p>
            <p>{{ resultDescription }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            resultCode: null,
            resultDescription: null,
            loading: false,
            errors: null
        };
    },
    async mounted() {
        this.loading = true;
        const getURL = this.getUrlString();
        const urlParam = encodeURIComponent(getURL.resourcePath);

        try {
            const response = await axios.get(`/api/confirmation/${urlParam}`);

            if (response.status === 200) {
                this.resultCode = response.data.result.code;
                this.resultDescription = response.data.result.description;
                console.log(response);
                this.loading = false;
            }
        } catch (error) {
            this.errors = error.response.data.errors;
            this.loading = false;
        }
    },
    methods: {
        getUrlString() {
            let url = {};
            let urlParams = window.location.href.replace(
                /[?&]+([^=&]+)=([^&]*)/gi,
                function(m, key, value) {
                    url[key] = value;
                }
            );
            return url;
        }
    }
};
</script>
