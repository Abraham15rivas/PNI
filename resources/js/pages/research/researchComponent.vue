<template>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5 class="center-align" >Indicador del tipo de institución e interés de investigación de las investigadoras e investigadores</h5>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Tipo de Institución</span>
                        <doughnut-charts v-if="loadedIns" :chartdata="institution" :height="'400px'"></doughnut-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Interés de Investigación</span>
                        <!-- <horizontalBar-charts :chartdata="" :options="options"></horizontalBar-charts> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Interés de Investigación por Género</span>
                        Aquí 3
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
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
            // Opciones Predefinidas
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            },
            backgroundColor: [
                'rgba(41, 98, 255, 0.5)',
                'rgba(98, 0, 234, 0.5)',
                'rgba(0, 191, 165, 0.5)',
                'rgba(230, 74, 25, 0.5)',
                'rgba(66, 66, 66, 0.5)',
                'rgba(197, 17, 98, 0.5)',
                'rgba(255, 214, 0, 0.5)',
                'rgba(183, 28, 28, 0.5)'
            ],
            borderColor: [
                'rgba(41, 98, 255, 1)',
                'rgba(98, 0, 234, 1)',
                'rgba(0, 191, 165, 1)',
                'rgba(230, 74, 25, 1)',
                'rgba(66, 66, 66, 1)',
                'rgba(197, 17, 98, 1)',
                'rgba(255, 214, 0, 1)',
                'rgba(183, 28, 28, 1)'
            ],
            /*
                rgba(41, 98, 255)   Violeta
                rgba(98, 0, 234)    Azul
                rgba(0, 191, 165)   Turquesa
                rgba(66, 66, 66)    Gris
                rgba(197, 17, 98)   Fucsia
                rgba(230, 74, 25)   Naranja
                rgba(255, 214, 0)   Amarillo
                rgba(183, 28, 28)   Rojo
            */ 

            //Grupo de institucion 
            institution: {},
            loadedIns: false,

            //Grupo de Interes
            interest: {},
            loadedInt: false,




            
        }
    },
    async mounted () {
        let url = 'statistics/investigators?interest=true';
        axios.get(url)
            .then(res => {          
                console.log(res.data);
                this.institution = this.groupInstitution(res.data.groupInstitution);
                this.interest = this.groupInterest(res.data.groupInterest);
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        groupInstitution(items){
            let data = {
                labels: [
                    'Comunitaria - ' + items['INSTITUCION COMUNITARIA'], 
                    'Educativa - ' + items['INSTITUCIÓN EDUCATIVA'],
                    'Investigación - ' + items['INSTITUCIÓN INVESTIGACIÓN'],
                    'Salud - ' + items['INSTITUCIÓN SALUD'],
                    'No Contestaron - ' + items['NO CONTESTARON']
                ],
                datasets: [{
                    data: [
                        items['INSTITUCION COMUNITARIA'],
                        items['INSTITUCIÓN EDUCATIVA'],
                        items['INSTITUCIÓN INVESTIGACIÓN'],
                        items['INSTITUCIÓN SALUD'],
                        items['NO CONTESTARON']
                    ],
                    backgroundColor: this.backgroundColor,
                    borderColor: this.borderColor,
                    hoverBackgroundColor: this.borderColor,
                    borderWidth: 1,
                    hoverBorderWidth: 2
                }]
            }
            this.loadedIns = true;
            return data;
        },
        groupInterest(items){
            console.log(items);
            let data = {
                labels: [],
                datasets: [
                    {
                        data: [],
                        backgroundColor: this.backgroundColor,
                        borderColor: this.borderColor,
                        hoverBackgroundColor: this.borderColor,
                        borderWidth: 1,
                        hoverBorderWidth: 2
                    }
                ]
            }

            return data;
        }
    }


}
</script>
