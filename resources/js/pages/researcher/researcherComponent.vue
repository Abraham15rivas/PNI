<template>
    <div class="container">
        <div class="row">
            <div class="col s12">
            <h2>Vista de Investigadores</h2>
            </div>
            <div class="col s12 m6 l3">
                <div class="card card-bg black-text">
                    <div class="card-content center">
                        <p>Total registrados</p>
                        <h5 class="green-text">{{total_investigators}}</h5>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card card-bg black-text">
                    <div class="card-content center">
                        <p>Investigadores</p>
                        <h5 class="blue-text">{{investigators_mens}}</h5>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card card-bg black-text">
                    <div class="card-content center">
                        <p>Investigadoras</p>
                        <h5 class="blue-text">{{investigators_womens}}</h5>
                    </div>
                </div>
            </div>
           
            <div class="col l3 m6 s12">

                <div class="card">
                    <div class="card-stacked">
                    <div class="card-metrics card-metrics-static">
                        <div class="card-metric">
                        <div class="card-metric-title">Conversion Rate</div>
                        <div class="card-metric-value">0.24%</div>
                        <div class="card-metric-change decrease">
                            <i class="material-icons left">keyboard_arrow_down</i>
                            9%
                        </div>
                        </div>
                    </div>
                    </div>
                
                </div>

            </div>

            <div class="col s12">

                <div class="card">
                    <div class="card-metrics card-metrics-toggle card-metrics-centered">
                    <div class="card-metric waves-effect active" data-metric="revenue">
                        <div class="card-metric-title">Revenue</div>
                        <div class="card-metric-value">$12,476.00</div>
                        <div class="card-metric-change">
                        <i class="material-icons">keyboard_arrow_up</i>
                        12%
                        </div>
                    </div>
                    <div class="card-metric waves-effect" data-metric="users">
                        <div class="card-metric-title">Users</div>
                        <div class="card-metric-value">2024</div>
                        <div class="card-metric-change">
                        <i class="material-icons">keyboard_arrow_up</i>
                        9%
                        </div>
                    </div>
                    <div class="card-metric waves-effect" data-metric="ctr">
                        <div class="card-metric-title">CTR</div>
                        <div class="card-metric-value">0.20%</div>
                        <div class="card-metric-change">
                        <i class="material-icons">keyboard_arrow_up</i>
                        4%
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                total_investigators: "",
                investigators_mens: "",
                investigators_womens: "",
            }
        },
        mounted() {
            this.totalInvestigators();
        },
        methods:{
            totalInvestigators(){
                let url = 'statistics/investigators';
                axios.get(url)
                    .then(res => {                        
                        this.total_investigators = res.data.total_investigators;
                        this.investigators_mens  = res.data.investigators_mens;
                        this.investigators_womens  = res.data.investigators_womens;
                    })
                    .catch(err => {
                        console.log(err);
                        
                    })
            }
        }
    }
</script>
