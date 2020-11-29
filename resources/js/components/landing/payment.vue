<template>
    <div class="col-lg-4 col-md-6 col-sm-6 mb-2 p-0 align-self-stretch">
        <div class="card" style="height: 100%">
            <div class="card-header bg-primary text-light">
                Reference: <strong>{{ merchant_transaction_id }}</strong>
            </div>
            <div class="card-body row">
                <div class="col-6">
                    <strong>Amount: {{ amount }}</strong>
                </div>
                <div class="col-6">
                    <strong>Date: {{ created_at }}</strong>
                </div>
            </div>
            <div
                v-if="!refunded"
                class="card-footer border-white bg-white text-center"
            >
                <button class="btn-primary" @click="loadRefund()">
                    Request Refund
                </button>
            </div>
            <div
                v-else
                class="text-center pb-3 border-white card-footer bg-white"
            >
                <strong>Payment Refunded</strong>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        created_at: String,
        merchant_transaction_id: [Number, String],
        amount: [Number, String],
        payment_code: [String, Number],
        id: [String, Number],
        refunded: Number
    },
    methods: {
        async loadRefund() {
            try {
                const req = await axios.post(
                    `/api/payments/${this.id}/${this.payment_code}`
                );
                console.log(req);

                if (req.status === 200) {
                    alert(req.data.result.description);
                    this.$router.go();
                }
            } catch (error) {
                alert(error.req.data.errors);
                this.$router.go();
            }
        }
    }
};
</script>
