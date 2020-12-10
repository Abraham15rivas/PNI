<template>
    <div class="margin-x">
        <div class="row">
            <div class="col s12">
                <h5 class="center">
                    Indicador de Investigadoras e Investigadores registrados en el Programa Nacional de Investigadores
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m7">
                <div class="card horizontal">
                    <div class="card-image card-icon">
                        <img class="img-fluid size-img" src="images/registro.svg">
                    </div>
                    <div class="card-stacked">
                        <div class="card-body">
                            <h5 class="center-align">Total de investigadores registrados</h5>
                            <h4 class="center-align">{{total_investigators}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m5">  
                <div class="card horizontal">
                    <div class="card-image card-icon">
                        <img class="icon-fm img-fluid size-img" src="images/genero.png">
                    </div>                    
                    <div class="card-stacked">
                        <div class="card-body">
                            <div class="row">
                                <div class="col s12 m12 xl6">
                                    <h5 class="center-align color-w ml-5">Mujeres</h5>
                                    <h5 class="center-align color-w">{{investigators_womens}}</h5>
                                </div>
                                <div class="col s12 m12 xl6">
                                    <h5 class="center-align color-m">Hombres</h5>
                                    <h5 class="center-align color-m">{{investigators_mens}}</h5>                                
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content center">
                        <span class="card-title">Investigadores por rango de edad</span>
                        <bar-charts v-if="show.dataAge" :chartdata="datacollectionn" :height="180"></bar-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content center">
                        <span class="card-title">Investigadores por estados</span>
                        <bar-charts v-if="show.dataState" :chartdata="datacollection" :height="180"></bar-charts>
                    </div>                    
                    <div class="row" style="padding: 0px 24px">
                        <div class="col s6" v-if="dataStates.length > 0">
                            <md-field>
                                <label for="state">Estados</label>
                                <md-select v-model="selectedState" name="state" id="state" v-on:md-selected="searchMunicipalities()">
                                    <md-option v-for="(state,index) of dataStates" :key="index" :value="state.id">{{state.estado}}</md-option>
                                </md-select>
                            </md-field>
                        </div>
                        <div class="col s6" v-if="dataMunicipalities.length > 0">
                            <md-field>
                                <label for="state">Municipios</label>
                                <md-select v-model="selectedMunicipality" name="municipality" id="municipality" v-on:md-selected="searchParish()">
                                    <md-option v-for="(mun,index) of dataMunicipalities" :key="index" :value="mun.id">{{mun.municipio}}</md-option>
                                </md-select>
                            </md-field>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m8 offset-m2">
                <div class="card">
                    <div class="card-content">
                        <table class="table table-striped table-hover responsive-table">
                            <thead>
                                <tr>
                                    <th>Edades</th>
                                    <th>Masculino</th>
                                    <th>Femenino</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Promedio</td>
                                    <td>{{proMasc}}</td>
                                    <td>{{proFeme}}</td>
                                    <td>{{proTotal}}</td>
                                </tr>
                                <tr>
                                    <td>Maxima</td>
                                    <td>{{maxMasc}}</td>
                                    <td>{{maxFeme}}</td>
                                    <td>{{maxTotal}}</td>                                    
                                </tr>
                                <tr>
                                    <td>Minima</td>
                                    <td>{{minMasc}}</td>
                                    <td>{{minFeme}}</td>
                                    <td>{{minTotal}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card card-bg">
                    <div class="card-content center">
                        <span class="card-title">Investigadores por Profesión</span>
                       <bar-charts v-if="show.dataState" :chartdata="profesions" :height="150"></bar-charts>
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
                datacollection: {},
                datacollectionn: {},
                dataStates:[],
                dataMunicipalities:[],
                dataParish:[],
                profesions: [],
                averageAge: [],
                loading:true,

                selectedState:0,
                selectedMunicipality:0,

                proFeme: '',
                proMasc: '',
                proTotal: '',

                minFeme: '',
                minMasc: '',
                minTotal: '',

                maxFeme: '',
                maxMasc: '',
                maxTotal: '',

                show: {
                    dataAge: false,
                    dataState: false
                }
            }
        },
        mounted() {
            this.loading = true;
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
                            this.dataStates = states;                        
                        }
                        this.datacollection = {
                            labels: nameStates,
                            datasets: [{
                                label: 'Total investigadores por estado',
                                backgroundColor: '#1976d2',
                                data: num
                            }]
                        }
                        
                        //Grafica de 
                        this.profesions = this.groupInv(res.data.groupProfesion, 'profesion');

                        let rangeAge = res.data.groupRangeAge;
                        let range = new Array();
                        let totalRange    = new Array();

                        if (rangeAge) {
                            rangeAge.forEach(element => {
                                range.push(element.titulo);
                                totalRange.push(element.total)
                            });                            
                        }

                        this.datacollectionn = {
                            labels: range,
                            datasets: [{
                                label: 'Rango de edades',
                                backgroundColor: '#1976d2',
                                data: totalRange
                            }]
                        }
                        this.averageAge = res.data.groupAverageAge;

                        this.proMasc = this.averageAge.promedio.masculino
                        this.proFeme = this.averageAge.promedio.femenino
                        this.proTotal = this.averageAge.promedio.total

                        this.minMasc = this.averageAge.minima.masculino
                        this.minFeme = this.averageAge.minima.femenino
                        this.minTotal = this.averageAge.minima.total

                        this.maxMasc = this.averageAge.maxima.masculino
                        this.maxFeme = this.averageAge.maxima.femenino
                        this.maxTotal = this.averageAge.maxima.total
                        this.show.dataState = true;
                        this.show.dataAge = true;  
                        this.loading = false;                             
                    })
                    .catch(err => {
                        console.log(err);  
                    })
            },

            searchMunicipalities(){
                this.show.dataState = false;
                this.loading = true;
                let url = `statistics/investigators/municipality/${this.selectedState}`;
                axios.get(url)
                    .then(res => {
                        let municipalities = res.data.municipios;
                        let nameMunicipality = new Array();
                        let num    = new Array();


                        if (municipalities) {
                            municipalities.forEach(element => {
                                nameMunicipality.push(element.municipio);
                                num.push(element.total)
                            });   
                            this.dataMunicipalities = municipalities;                        
                        }
                        this.datacollection = {
                            labels: nameMunicipality,
                            datasets: [{
                                label: 'Total investigadores del estado '+ this.dataStates.find(v => v.id == this.selectedState).estado +' por Municipios',
                                backgroundColor: '#1976d2',
                                data: num
                            }]
                        }
                        
                        this.show.dataState = true;  
                        this.loading = false;                          
                    })
                    .catch(err => {
                        console.log(err);  
                    })
            },
            searchParish(){
                this.show.dataState = false;
                this.loading = true;
                let url = `statistics/investigators/parish/${this.selectedMunicipality}`;
                axios.get(url)
                    .then(res => {
                        let parish = res.data.parroquias;
                        let nameParish = new Array();
                        let num    = new Array();


                        if (parish) {
                            parish.forEach(element => {
                                nameParish.push(element.parroquia);
                                num.push(element.total)
                            });   
                            this.dataParish = parish;                        
                        }
                        this.datacollection = {
                            labels: nameParish,
                            datasets: [{
                                label: 'Total investigadores del Municipio '+ this.dataMunicipalities.find(v => v.id == this.selectedMunicipality).municipio +' por Parroquias',
                                backgroundColor: '#1976d2',
                                data: num
                            }]
                        }
                        
                        this.show.dataState = true;  
                        this.loading = false;                          
                    })
                    .catch(err => {
                        console.log(err);  
                    })
            },
            groupInv(items, title){ //Funcion para agregar graficas
                let labels = [];
                let info = [];
                let female = [];
                let male = [];

                items.forEach(item => {
                    let palabra = item[title].toLowerCase();
                    labels.push(palabra[0].toUpperCase() + palabra.slice(1));
                    info.push(item.total);

                    if(item?.female)
                        female.push(item.female);

                    if(item?.male)
                        male.push(item.male);
                });
                let data = {
                    labels: labels,
                    datasets: [{
                        data: info,
                        label: 'Total',
                        backgroundColor: 'rgba(66, 66, 66, 0.5)',
                        borderColor: 'rgba(66, 66, 66, 1)',
                        hoverBackgroundColor: 'rgba(66, 66, 66, 1)',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    }
                    ],
                }

                if(female.length > 0)
                    data.datasets.push({
                        data: female,
                        label: 'Femenino',
                        backgroundColor: 'rgba(255, 214, 0, 0.5)',
                        borderColor: 'rgba(255, 214, 0, 1)',
                        hoverBackgroundColor: 'rgba(255, 214, 0, 1)',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    });
                
                if(male.length > 0)
                    data.datasets.push({
                        data: male,
                        label: 'Masculino',
                        backgroundColor: 'rgba(41, 98, 255, 0.5)',
                        borderColor: 'rgba(41, 98, 255, 1)',
                        hoverBackgroundColor: 'rgba(41, 98, 255, 1)',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    });

                return data;
            }
        }
    }
</script>
<style scoped>
hr{ width: 100% }

.md-button, .md-button-clean{
    background-color: white;
}

.card-icon {
    background: #e3f2fd;
    display: flex;
    align-items: center;
    padding: 0px 8px 0px 16px;
}

.margin-x{
    margin: 0 25px;
    padding-top: 32px;
}

.size-img{ 
    width: 100px; 
    height: 100px;
}

.color-w { color: #EA5771 }
.color-m{ color:#1E88E5}

@media (max-width: 320px) {
    .card-icon{ display: none; }
}
</style>
