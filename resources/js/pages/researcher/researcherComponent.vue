<template>
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col s12">
            <h5 class="center">Indicador de Investigadoras e Investigadores registrados en el Programa Nacional de Investigadores</h5>
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
            <div class="col l12 m6 s12">
                <div class="card card-bg">
                    <div class="card-content">
                         <Bar :chart-data="datacollection" :height="250"></Bar>
                    </div>
                </div>
            </div>
            <!--table>
                <thead>
                    <tr>
                        <th>Profesión</th>
                        <th>Investigadores (as)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(profesion, index) in profesions" :key="index">
                        <td>{{profesion.profesion}}</td>
                        <td>{{profesion.total}}</td>
                    </tr>
                </tbody>
            </table-->
            <table>
                <thead>
                    <tr>
                        <th>Edades</th>
                        <th>Minima</th>
                        <th>Maxima</th>
                        <th>Promedio</th>
                    </tr>
                </thead>
                <tbody>               
    
                   
                    <tr v-for="(averageAge, index) in averageAge" :key="index">
                        <td >{{averageAge.promedio}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Bar from '../../charts'

    export default {
        components: {
            Bar
        },
        data() {
            return {
                total_investigators: "",
                investigators_mens: "",
                investigators_womens: "",
                datacollection: null,
                datacollectionn: null,
                profesions: [],
                averageAge: []
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

                        this.total_investigators = res.data.total_investigators; //TOTAL DE INVESTIGADORES
                        this.investigators_mens  = res.data.investigators_mens; //TOTAL DE INVESTIGADORES HOMBRES
                        this.investigators_womens  = res.data.investigators_womens; //TOTAL DE INVESTIGADORAS   

                        let states = res.data.groupStates;
                        let nameStates = new Array();
                        let num    = new Array();

                        if (states) {
                            states.forEach(element => {
                                nameStates.push(element.estado);
                                num.push(element.total)
                            });                            
                        }
                        this.datacollection = {
                            labels: nameStates,
                            datasets: [{
                                label: 'Total',
                                backgroundColor: '#1976d2',
                                data: num
                            }]
                        }
                        this.profesions = res.data.groupProfesion;
                        this.averageAge = res.data.groupAverageAge;
                        
                        
                    })
                    .catch(err => {
                        console.log(err);
                        
                    })
            }
        }
    }
</script>
