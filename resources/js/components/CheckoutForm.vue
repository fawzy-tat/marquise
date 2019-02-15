<template>
    <form method="POST" action="/purchaces">
        <input type="hidden" v-model="stripeToken" name="stripeToken">
        <input type="hidden" v-model="stripeEmail" name="stripeEmail">
        <button type="submit" @click.prevent="buy"> Buy my book </button>
    </form>
</template>

<script>
    
    export default {
        data(){
            return{
            stripeToken : '',
            stripeEmail : ''
             }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.stripe = StripeCheckout.configure({
                key: "pk_test_h7EltuJ37p02mAyh6maULR54",
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale:"auto",
                token: (token) =>{
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;
                    
                    axios.post('/purchases', this.$data)
                        .then(response => alert('Complete! Thanks for your payment!'));
                }
            })
        },
        methods:{
            buy() {
                this.stripe.open({
                    amount:2500,
                    name:'fawzytat',
                    description:'Widget',
                    zipCode:true
                })
            }
        }
    }
</script>
