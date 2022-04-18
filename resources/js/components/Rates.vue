<template>
    <div class="row">
        <div class="col-3 offset-4 pb-3">

            <h1 class="h2">Price Alerts</h1>
            <small class="form-text text-muted">Enter E-mail and price for alerts. If price goes above, you will be
                notified.</small>
        </div>

        <div class="row">
            <div class="col-sm-8 col-md-6 col-xl-4 offset-sm-2 offset-md-3 offset-xl-4">
                <form action="" method="post" class="clearfix"
                      id="createStoreContractor">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" v-model="email" class="form-control" id="email"
                               aria-describedby="emailHelp"
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" v-model="price" class="form-control" id="price"
                               placeholder="price">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right" @click.prevent="onSubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import {
    Chart,
    ArcElement,
    LineElement,
    BarElement,
    PointElement,
    BarController,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,
    SubTitle
} from 'chart.js';

Chart.register(
    ArcElement,
    LineElement,
    BarElement,
    PointElement,
    BarController,
    BubbleController,
    DoughnutController,
    LineController,
    PieController,
    PolarAreaController,
    RadarController,
    ScatterController,
    CategoryScale,
    LinearScale,
    LogarithmicScale,
    RadialLinearScale,
    TimeScale,
    TimeSeriesScale,
    Decimation,
    Filler,
    Legend,
    Title,
    Tooltip,
    SubTitle
);

export default {
    name: "Rates",
    data() {
        return {
            errors: [],
            email: null,
            price: null
        }
    },
    props: ['prices', 'dates'],
    methods: {

        onSubmit: function () {
            if (this.checkform()) {
                axios.post('/add_to_price_alert', {"price": this.price, "email": this.email})
                    .then((response) => {
                        if(response.data.success) {

                        this.flashMessage.success({
                            title: 'Success',
                            message: 'Email successfully added.'
                        });
                        }else {
                            this.flashMessage.error({
                                title: 'Error',
                                message: 'There was an error while adding the alert.',
                            });
                        }
                    }), (error) => {
                    this.flashMessage.error({
                        title: 'Error',
                        message: 'There was an error while adding the alert.',
                    });
                }

            }
        },
        checkform: function () {
            let error = false;

            if (!this.email) {
                error = 'Email required';
            } else if (!this.validEmail(this.email)) {
                error = 'Valid email required';
            }
            if (!this.price) {
                error = 'Price required.';
            }

            if (error) {
                this.flashMessage.error({
                    title: 'Error',
                    message: error
                });
                return false;
            }

            return true;

        },
        validEmail: function (email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    },
    mounted() {
        const data = {
            labels: this.dates,
            datasets: [
                {
                    label: 'Price',
                    data: this.prices,
                    borderColor: ['blue'],
                    fill: false,
                    tension: 0
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: ''
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Bitcoin Price Linear in US Dollars'
                        },
                    }
                }
            },
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    }
}
</script>

<style scoped>

</style>
