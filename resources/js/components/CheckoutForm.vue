<template>
    <form method="POST" action="/purchaces">
        <input type="hidden" v-model="stripeToken" name="stripeToken">
        <input type="hidden" v-model="stripeEmail" name="stripeEmail">
        <select name="product" v-model="product">
            <option v-for="product in products" v-bind:key="product.id" :value="product.id">
                {{ product.name }} &mdash; $ {{ product.price /100 }}
            </option>
        </select>
        <button type="submit" @click.prevent="buy"> Buy my book </button>
    </form>
</template>

<script>
    
    export default {
        props :['products'],
        data(){
            return{
            stripeToken : '',
            stripeEmail : '',
            product: 1
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
                    axios.post('/purchases', this.$data) // stripeToken,StripeEmail, Selected ProductID
                        .then(response => alert('Complete! Thanks for your payment!'));
                }
            })
        },
        methods:{
            buy() {
                let product = this.findProductById(this.product);

                this.stripe.open({
                    amount: product.price,
                    name:product.name,
                    description:product.description,
                    zipCode:true
                })
            },
            findProductById(id){
               return this.products.find(product => product.id == id);
            }
        }
    }
</script>
