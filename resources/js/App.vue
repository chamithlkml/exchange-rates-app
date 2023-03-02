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
    <div class="container">
        <div class="row">
            <div class="col-4 col-sm-2"></div>
            <div class="col-4 col-sm-8">
                <h1>USD Exchange Rates</h1>
                <br/>
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
                <button></button>
            </div>
            <div class="col-4 col-sm-2"></div>
        </div>
    </div>
</template>
