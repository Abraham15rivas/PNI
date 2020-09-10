<template>
    <div class="margin-x">
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
                        <doughnut-charts v-if="loadedIns" :chartdata="institution"></doughnut-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Interés de Investigación</span>
                        <line-charts v-if="loadedInt" :chartdata="interest"></line-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Interés de Investigación por Género</span>
                        <table class="highlight striped">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Masculino</th>
                                    <th>Femenino</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody v-if="loadedInt">
                                <tr v-for="(item, index) in dataInterest" v-bind:key="index">
                                    <td>{{ item.titulo }}</td>
                                    <td>{{ item.masculino }}</td>
                                    <td>{{ item.femenino }}</td>
                                    <td>{{ item.total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Investigación Actual</span>
                        <horizontalBar-charts v-if="loadedAct" :chartdata="actualInt"></horizontalBar-charts>
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
                legend: {
                    align: "end"
                },
                element: {
                    radius: 20
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
            dataInterest: {},
            loadedInt: false,

            //Grupo de Interes
            actualInt: {}, 
            loadedAct: false,
        }
    },
    async mounted () {
        let url = 'statistics/investigators/interest';
        axios.get(url)
            .then(res => {          
                this.institution = this.groupInstitution(res.data.groupInstitution);
                this.dataInterest = res.data.groupInterest;
                this.interest = this.groupInterest(res.data.groupInterest);
                this.actualInt = this.groupActualInt(res.data.actualInvestigation);
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        groupInstitution(items){
            let labels = [];
            let info = []

            items.forEach(item => {
                item.titulo = item.titulo.toLowerCase();
                let palabra = item.titulo.split(' ');

                if(palabra[0] === 'institucion' || palabra[0] === 'institución' ){
                    labels.push(palabra[1][0].toUpperCase() + palabra[1].slice(1));
                }else{
                    labels.push(item.titulo[0].toUpperCase() + item.titulo.slice(1));
                }
                info.push(item.total);
            });

            let data = {
                labels: labels,
                datasets: [{
                    data: info,
                    backgroundColor: this.backgroundColor,
                    borderColor: this.borderColor,
                    hoverBackgroundColor: this.borderColor,
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                    
                }],
            }
            this.loadedIns = true;
            return data;
        },
        groupInterest(items){
            let labels = [];
            let info = [];
            let content = [];

            items.forEach(item => {
                if(item['titulo'] != "TOTALES"){
                    
                    item.titulo = item.titulo.toLowerCase();
                    labels.push(item.titulo[0].toUpperCase() + item.titulo.slice(1)); 
                    info.push(item.total);
                }
            });

            let data = {
                labels: labels,
                datasets: [
                    {
                        data: info,
                        label: 'Cantidad de Investigadores',
                        backgroundColor: ["rgba(0, 0, 0, 0)"],
                        borderColor: this.borderColor,
                        hoverBackgroundColor: this.borderColor,
                        borderWidth: 1,
                        hoverBorderWidth: 30,
                        steppedLine: "middle"
                    }
                ]
            }
            this.loadedInt = true;
            return data;
        },
        groupActualInt(items){
            let labels = [];
            let info = [];
            let content = [];

            items.forEach(item => {
                if(item['titulo'] != "TOTALES"){
                    item.titulo = item.titulo.toLowerCase();
                    labels.push(item.titulo[0].toUpperCase() + item.titulo.slice(1)); 
                    info.push(item.total);
                }
            });

            let data = {
                labels: labels,
                datasets: [
                    {
                        data: info,
                        label: 'Cantidad de Investigadores',
                        backgroundColor: this.backgroundColor,
                        borderColor: this.borderColor,
                        hoverBackgroundColor: this.borderColor,
                        borderWidth: 1,
                        hoverBorderWidth: 2
                    }
                ]
            }
            this.loadedAct = true;
            return data;
        }
    }


}
</script>


<style>

.margin-x{
    margin: 0 50px;
    padding-top: 32px;
}

</style>