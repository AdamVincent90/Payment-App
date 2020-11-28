<template>
    <div class="card">
        <div class="card-header">
            Reference: {{id}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                   Amount: {{amount}}
                </div>
                <div class="col-6">
                    {{created_at}}
                </div>
            </div>
             <div class="card-footer bg-white text-center pt-2">
                    <button class="btn-primary">Request Refund</button>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        created_at: String,
        id: [Number, String],
        amount: [Number, String]
    },


}
</script>