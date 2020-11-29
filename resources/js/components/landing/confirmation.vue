<template>
    <div>
        <div
            v-if="loading"
            class="spinner-border text-primary text-center"
            role="status"
        ></div>
        <div v-else class="container">
            <div class="card">
                <div class="card-header bg-light">
                    <h1 class="text-primary">Payment Complete</h1>
                </div>
                <div class="card-body">
                    <strong>Code: {{ resultCode }}</strong>
                    <h3>{{ resultDescription }}</h3>
                    <p>Your payments can be viewed from your landing page</p>
                </div>
                <div class="card-footer bg-light">
                    <router-link :to="{name: 'landing'}">Back</router-link>
                </div>
            </div>
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
            errors: null,
            paymentData: null
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

                try {
                    const user = await axios.get("/user");
                    console.log(user.data.id);
                    const addPayment = await axios.post("/api/payments", {
                        paymentInfo: response.data,
                        userId: user.data.id
                    });

                    if (addPayment.status === 200) {
                        console.log("payment added");
                        console.log(addPayment);
                    }
                } catch (error) {
                    console.log(error);
                }

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
