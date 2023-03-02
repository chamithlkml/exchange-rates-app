<script>
import axios from 'axios'
export default{
    data(){
        return {
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
    <table>
        <thead style="background-color: turquoise;">
            <tr>
                <th>US Dollar Exchange Rates</th>
                <th></th>
            </tr>
            <tr style="text-align: right">
                <th>1 USD = </th>
                <th></th>
            </tr>
        </thead>
        <tbody v-for="currency in currencies">
            <tr>
                <td>{{ currency.label}}</td>
                <td>{{ currency.rate}}</td>
            </tr>
        </tbody>
    </table>
</template>
