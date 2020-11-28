<template>
    <div class="container pt-3">
        <h2 class="text-primary text-center">
            Enter payment details
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
                    <option value="GBP" >GBP</option>
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
          <form ref="payment" action="/confirmation/" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form> 
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            amount: null,
            reference: null,
            selected: null,
            referenceId: null
        };
    },
    beforeCreate() {
        this.$store.dispatch("checkUser");
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
