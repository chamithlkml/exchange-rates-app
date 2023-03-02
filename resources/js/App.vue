<script>
import axios from 'axios'
export default{
    data(){
        return {
            title: 'Showing exchange rates',
            currencies: []
        }
    },
    mounted() {
        console.log(window.currencies)
        this.currencies = window.currencies
    }
}
</script>
<template>
    <h1>USD Exchange Rates</h1>
    <h2>{{ title }}</h2>
    <ul v-for="currency in currencies">
        <li>{{ currency['label'] }}</li>
    </ul>
</template>
