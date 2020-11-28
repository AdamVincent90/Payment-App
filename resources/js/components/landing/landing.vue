<template>
    <div class="container pt-3">
        <h2 class="text-primary text-center">
            Create Payment
        </h2>
        <div v-if="!referenceId" class="row text-center pt-3">
            <div class="col-2">
                <strong>Currency</strong>
                <select
                    class="form-control form-control-sm"
                    name="currency"
                    v-model="selected"
                >
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="USD">USD</option>
                </select>
            </div>
            <div class="col-3">
                <strong>Amount</strong>
                <input
                    type="text"
                    class="form-control form-control-sm"
                    name="amount"
                    v-model="amount"
                    placeholder="Amount to pay"
                />
            </div>
            <div class="col-7">
                <strong>Reference</strong>
                <input
                    type="text"
                    class="form-control form-control-sm"
                    name="reference"
                    v-model="reference"
                    placeholder="ReferenceID"
                />
            </div>
            <div class="d-flex w-100 justify-content-center pt-2">
                <button class="btn-primary w-50" @click="loadGateway()">
                    Submit
                </button>
            </div>
        </div>
        <div class="pt-5">
            <form
                ref="payment"
                action="/confirmation/"
                class="paymentWidgets"
                data-brands="VISA MASTER AMEX"
            ></form>
        </div>
        <h4 class="text-secondary">Your Payment History</h4>
        <div class="pt-3">
            <div
                v-if="loading"
                class="spinner-border text-primary text-center"
                role="status"
            ></div>
            <div v-else class="row">
                <payment
                    v-for="payment in payments"
                    :key="payment.id"
                    v-bind="payment"
                ></payment>
            </div>
        </div>
    </div>
</template>
<script>
import Payment from "./payment";

export default {
    data() {
        return {
            amount: null,
            reference: null,
            selected: null,
            referenceId: null,
            payments: null,
            loading: false
        };
    },
    components: {
        Payment
    },
    beforeCreate() {
        this.$store.dispatch("checkUser");
    },
    async created() {
        this.loading = true;
        try {
            await axios.get('/sanctum/csrf-cookie');
            const user = await axios.get('/user');
            const request = await axios.get(`/api/users/${user.data.id}/payments`);

            this.payments = request.data;
            console.log(this.payments);
            this.loading = false;

        } catch (error) {
            console.log(error);
        }

    },
    methods: {
        async loadGateway() {
            console.log("works!");

            try {
                const req = await axios.post("/payment", {
                    amount: this.amount,
                    reference: this.reference,
                    currency: this.selected
                });

                console.log(req);
                this.referenceId = req.data.id;
                this.createPaymentScript();
            } catch (error) {
                console.log(error);
            }
        },
        createPaymentScript() {
            let paymentScript = document.createElement("script");
            paymentScript.setAttribute(
                "src", `https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=${this.referenceId}`
            );
           this.$refs.payment.appendChild(paymentScript);
        }
    }
};
</script>
