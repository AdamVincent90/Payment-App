<template>
    <div class="container pt-3">
        <h2 class="text-primary text-center">
            Create Payment
        </h2>
        <div
            v-if="!referenceId"
            class="row text-center pt-3 bg-primary border border-secondary"
        >
            <div class="container">
                <button class="btn-light mb-2" @click="generateReference()">
                    Generate Reference
                </button>
            </div>
            <div class="col-lg-2 col-sm-12 text-light">
                <strong>Currency</strong>
                <select
                    class="form-control form-control-sm"
                    name="currency"
                    v-model="selected"
                    :class="[{ 'is-invalid': this.errorHandler('currency') }]"
                >
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="USD">USD</option>
                </select>
                <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('currency')"
                    :key="'currency' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 text-light">
                <strong>Amount</strong>
                <input
                    type="text"
                    class="form-control form-control-sm"
                    name="amount"
                    v-model="amount"
                    placeholder="Amount to pay"
                    :class="[{ 'is-invalid': this.errorHandler('amount') }]"
                />
                <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('amount')"
                    :key="'amount' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 text-light">
                <strong>Reference</strong>
                <input
                    type="text"
                    class="form-control form-control-sm"
                    name="reference"
                    v-model="reference"
                    placeholder="ReferenceID"
                    :class="[{ 'is-invalid': this.errorHandler('reference') }]"
                />
                <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('reference')"
                    :key="'reference' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="d-flex w-100 justify-content-center pt-4 pb-1">
                <button class="btn-light w-50" @click="loadGateway()">
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
        <div v-if="!referenceId" class="pt-1">
            <h4 class="text-secondary">Your Payment History</h4>
            <div class="text-center"
                v-if="loading"
            ><p class="spinner-border mt-5 text-primary"
                role="status"></p></div>
            <div v-else class="row d-flex align-items-stretch">
                <payment
                    v-for="(payment, index) in payments"
                    :key="index"
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
            loading: false,
            errors: null,
            user: null
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
            await axios.get("/sanctum/csrf-cookie");
            const user = await axios.get("/user");
            this.user = user.data.name;
            const request = await axios.get(
                `/api/users/${user.data.id}/payments`
            );
            this.payments = request.data.data;
            console.log(this.payments);
            this.loading = false;
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        async loadGateway() {
            this.errors = null;

            try {
                const req = await axios.post("/payment", {
                    amount: this.amount,
                    reference: this.reference,
                    currency: this.selected,
                    user: this.user
                });
                console.log(req);
                this.referenceId = req.data.id;
                this.createPaymentScript();
            } catch (error) {
                this.errors = error.response.data.errors;
            }
        },
        createPaymentScript() {
            let paymentScript = document.createElement("script");
            paymentScript.setAttribute(
                "src",
                `https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=${this.referenceId}`
            );
            this.$refs.payment.appendChild(paymentScript);
        },
        generateReference() {
            // This will never always generate a unique number, but a development generator for dev purposes.
            return (this.reference = Math.floor(Math.random() * Date.now()));
        },
        errorHandler(field) {
            return this.errors ? this.errors[field] : null;
        }
    }
};
</script>

<style scoped>
.invalid-feedback {
    color: white;
}
</style>
