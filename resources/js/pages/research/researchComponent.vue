<template>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5 class="center-align" >Indicador del tipo de institución e interés de investigación de las investigadoras e investigadores</h5>
            </div>
        </div>

        <div class="row">
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Tipo de Institución</span>
                        Aquí
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Interés de Investigación</span>
                        <line-charts :chartdata="data" :options="options"></line-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Interés de Investigación por Género</span>
                        Aquí 3
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Investigación Actual</span>
                        Aquí 4
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    
</template>

<script>

export default {
    data(){
        return {
            data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        }
    },
    mounted () {
        console.log(this.data);
        console.log(this.options);
    }
}
</script>
