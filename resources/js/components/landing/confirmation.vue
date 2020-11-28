<template>
    <div>
        PAYMENT COMPLETE
        <div v-if="loading" class="spinner-border text-primary" role="status"></div>
        <div v-else class="container">
            <p>{{resultCode}}</p>
            <p>{{resultDescription}}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            resultCode: null,
            resultDescription: null,
            loading: false
        }
    },
    async mounted() {
        
        this.loading = true;
        const getURL = this.getUrlVars();
        const urlParam = encodeURIComponent(getURL.resourcePath);

       const response = await axios.get(`/api/confirmation/${urlParam}`);
        console.log(response);
        if(response.status === 200) 
        {
            this.resultCode = response.data.result.code;
            this.resultDescription = response.data.result.description;
            this.loading = false;
        }
       

    },
    methods: {
    getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
    }
}
</script>