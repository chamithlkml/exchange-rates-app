<script>
import axios from 'axios'
export default{
    data(){
        return {
            currencies: []
        }
    },
    mounted() {
        this.currencies = window.currencies
    },
    methods: {
        refreshRates(e){
            e.preventDefault()
            let currentObj = this
            axios
            .get('./api/exchange_rates')
            .then(response => {
                this.currencies = response.data
            })
            .catch(error => console.log(error))
        }
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
                    <thead class="table-header">
                        <tr>
                            <th>US Dollar Exchange Rates</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>1 USD = </th>
                        </tr>
                    </thead>
                    <tbody v-for="currency in currencies">
                        <tr>
                            <td>{{ currency.label}}</td>
                            <td>{{ currency.rate}}</td>
                        </tr>
                    </tbody>
                </table>
                <br/>
                <button v-on:click="refreshRates" type="button" class="btn btn-secondary">Refresh</button>
            </div>
            <div class="col-4 col-sm-2"></div>
        </div>
    </div>
</template>
