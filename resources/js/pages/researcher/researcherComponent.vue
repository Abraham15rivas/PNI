<template>
    <div class="margin-x">
        <loader :load="load" />    
        <div class="row">
            <div class="col s12">
                <h5 class="center">
                    Indicador de Investigadoras e Investigadores Rregistrados en el Programa Nacional de Investigadores
                </h5>
            </div>
        </div>
        <div class="row"> 
            <div class="col s12 m4">
                <div class="card horizontal">
                    <div class="card-image card-icon">
                        <img class="img-fluid size-img" src="images/registro.svg">
                    </div>
                    <div class="card-stacked">
                        <div class="card-body">
                            <h5 class="center-align">Total de Investigadores Registrados</h5>
                            <h4 class="center-align">{{investigators.total_inv}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m8">  
                <div class="card horizontal">
                    <div class="card-image card-icon">
                        <img class="icon-fm img-fluid size-img" src="images/genero.png">
                    </div>                    
                    <div class="card-stacked">
                        <div class="card-body">
                            <div class="row">
                                <div class="col s12 m3 xl4">
                                    <h5 class="center-align color-w ml-5">Mujeres</h5>
                                    <h5 class="center-align color-w">{{investigators.inv_womens}}</h5>
                                </div>
                                <div class="col s12 m3 xl4">
                                    <h5 class="center-align color-m">Hombres</h5>
                                    <h5 class="center-align color-m">{{investigators.inv_mens}}</h5>                                
                                </div> 
                                <div class="col s12 m3 xl4">
                                    <h5 class="center-align color-g">Sin Contestar</h5>
                                    <h5 class="center-align color-g">{{inv.investigatorsNot}}</h5>                                
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
                        <span class="card-title">Investigadores por Rango de Edad</span>
                        <bar-charts v-if="show.dataAge" :chartdata="rangeAges" :height="180"></bar-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content center">
                        <span class="card-title">Investigadores por Estados</span>
                        <bar-charts v-if="show.dataState" :chartdata="datacollection" :height="180"></bar-charts>
                    </div>                    
                    <div class="row" style="padding: 0px 24px">
                         <div class="col s4" v-if="dataMunicipalities.length > 0">
                            <md-button class="md-primary md-raised" @click="gruopStates()">Recargar</md-button>
                        </div>
                        <div class="col s4" v-if="dataStates.length > 0">
                            <md-field>
                                <label for="state">Estados</label>
                                <md-select v-model="selectedState" name="state" id="state" v-on:md-selected="searchMunicipalities()">
                                    <md-option v-for="(state,index) of dataStates" :key="index" :value="state.id">{{state.estado}}</md-option>
                                </md-select>
                            </md-field>
                        </div>
                        <div class="col s4" v-if="dataMunicipalities.length > 0">
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
            <div class="col s12">
                <div class="card">
                    <div class="card-content center">
                        <span class="card-title">Investigadores por Edades Según su Ubicación Geográfica (Estado)</span>
                        <div class="row" style="padding: 0px 24px">
                            <div class="col s12" v-if="dataStates.length > 0">
                                <md-field>
                                    <label for="stateAge">Seleccione un Estado</label>
                                    <md-select v-model="selectedStateAge" name="stateAge" id="stateAge" v-on:md-selected="changeState()">
                                        <md-option v-for="(state,index) of dataStates2" :key="index" :value="state.id">{{state.estado}}</md-option>
                                    </md-select>
                                </md-field>
                            </div>
                        </div> 
                        <bar-charts v-if="show.dataStateAge" :chartdata="edadGraph" :options="options" :height="180"></bar-charts>
                    </div>                    
                                       
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m8 offset-m2">
                <div class="card">
                    <div class="card-content center">
                        <span class="card-title">Promedio de Edades</span>
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
                                    <td>{{promedios.proMasc}}</td>
                                    <td>{{promedios.proFeme}}</td>
                                    <td>{{promedios.proTotal}}</td>
                                </tr>
                                <tr>
                                    <td>Máxima</td>
                                    <td>{{promedios.maxMasc}}</td>
                                    <td>{{promedios.maxFeme}}</td>
                                    <td>{{promedios.maxTotal}}</td>                                    
                                </tr>
                                <tr>
                                    <td>Mínima</td>
                                    <td>{{promedios.minMasc}}</td>
                                    <td>{{promedios.minFeme}}</td>
                                    <td>{{promedios.minTotal}}</td>
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
                        <span class="card-title">Investigadores por Profesión Según el Género</span>
                        <horizontalBar-charts v-if="show.dataState" :chartdata="profesions" :height="380"></horizontalBar-charts>
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
                totalGroupStates: [],
                total_investigators: "",
                investigators_mens: "",
                investigators_womens: "",
                dataStates2:[],
                dataStatesAge:[],
                loading:true,
                edadGraph: [],
                load: false,
                investigators: {},//render investigadores
                inv: {}, //data investigators
                
                datacollection: {}, //render chart states
                dataStates:[], //data states

                dataMunicipalities:[], //data municpalities
                dataParish:[], //data parish

                selectedState:0,
                selectedStateAge:0,
                selectedMunicipality:0,

                profesions: [],
                averageAge: [],       
                rangeAges: {},
                genero: {},

                av: {}, //average de edades
                promedios: {}, // promedio de edades
                
                show: {
                    dataAge: false,
                    dataState: false,
                    dataStateAge: false
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                    yAxes: [{
                        ticks: {
                        suggestedMin: 0,
                        stepSize: 1,
                        }
                    }]
                    }
                }
            }
        },
        async mounted() {
            const url = 'statistics/investigators';
            
            this.load = true;
            axios.get(url)
                .then(res => {
                    this.investigators = this.totalInvestigators(res.data);
                    this.rangeAges     = this.rangeAge(res.data.groupRangeAge, 'genero');
                    this.promedios     = this.averageAges(res.data.groupAverageAge);
                    this.profesions    = this.groupInv(res.data.groupProfesion, 'profesion');   
                    this.dataStatesAge = res.data.groupAge;
                    this.totalGroupStates = res.data.groupStates
                    this.gruopStates()
                    this.show.dataState = true;

                    if (this.rangeAges ) {
                        this.show.dataAge = true
                    }
                    
                    setTimeout(() => {
                        this.load = false
                    }, 5000) 
                });   
        },
        methods:{
            gruopStates() {
                this.show.dataState = false;
                this.dataParish = []
                this.dataMunicipalities = []
                let data = this.totalGroupStates
                let nameStates = new Array();
                let num = new Array();
                if (data) {
                    data.forEach(element => {
                        nameStates.push(element.estado);
                        num.push(element.total)
                    });   
                    this.dataStates = data;                        
                    this.dataStates2 = data;                        
                }
                this.datacollection = {
                    labels: nameStates,
                    datasets: [{
                        label: 'Total de Investigadores por Estado',
                        backgroundColor: '#082A44',
                        hoverBackgroundColor: '#3D9EE8',
                        data: num
                    }]
                }
                setTimeout(() => this.show.dataState = true, 1000)  
                
            },
            totalInvestigators(data){               
                this.inv.total_inv          = data.total_investigators;  //TOTAL DE INVESTIGADORES
                this.inv.inv_mens           = data.investigators_mens;   //TOTAL DE INVESTIGADORES HOMBRES
                this.inv.inv_womens         = data.investigators_womens; //TOTAL DE INVESTIGADORAS   
                this.inv.investigatorsNot   = data.investigatorsNot; //TOTAL DE NO CONTESTARON              
                return this.inv;
            },
            averageAges(data){
                this.av.proMasc  = data.promedio.masculino
                this.av.proFeme  = data.promedio.femenino
                this.av.proTotal = data.promedio.total

                this.av.minMasc  = data.minima.masculino
                this.av.minFeme  = data.minima.femenino
                this.av.minTotal = data.minima.total

                this.av.maxMasc  = data.maxima.masculino
                this.av.maxFeme  = data.maxima.femenino
                this.av.maxTotal = data.maxima.total

                return this.av
            },
            changeState(){
                
                let stateName = this.dataStates.find(val => val.id == this.selectedStateAge).estado;
                console.log("nombre",stateName);
                let arrayState = this.dataStatesAge.find(val => val.estado == stateName);
                let self = this;
                if(this.show.dataStateAge){
                    this.show.dataStateAge = false;
                    setTimeout(function(){
                        self.edadGraph = self.groupInv(_.sortBy(Object.values(arrayState.data),['age']), 'age', false);
                        self.show.dataStateAge = true;
                    },100);
                }else{
                    this.edadGraph = this.groupInv(_.sortBy(Object.values(arrayState.data),['age']), 'age', false);
                    this.show.dataStateAge = true;
                }
            },
            searchMunicipalities(){
                this.show.dataState = false;
                const url = `statistics/investigators/municipality/${this.selectedState}`;
                axios.get(url)
                    .then(res => {
                        let municipalities = res.data.municipios;
                        let nameMunicipality = [];
                        let num = [];

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
                                label: 'Total de Investigadores del Estado '+ this.dataStates.find(v => v.id == this.selectedState).estado +' por Municipios',
                                backgroundColor: '#082A44',
                                hoverBackgroundColor: '#3D9EE8',
                                data: num
                            }]
                        }                        
                        this.show.dataState = true;  
                    })
                    .catch(err => {
                        console.log(err);  
                    })
            },
            searchParish(){
                this.show.dataState = false;
                const url = `statistics/investigators/parish/${this.selectedMunicipality}`;
                axios.get(url)
                    .then(res => {
                        let parish = res.data.parroquias;
                        let nameParish = [];
                        let num = [];

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
                                label: 'Total Investigadores del Municipio '+ this.dataMunicipalities.find(v => v.id == this.selectedMunicipality).municipio +' por Parroquias',
                                backgroundColor: '#082A44',
                                hoverBackgroundColor: '#3D9EE8',
                                data: num
                            }]
                        }
                        this.show.dataState = true;  
                    })
                    .catch(err => {
                        console.log(err);  
                    })
            },
            groupInv(items, title, flagTotal = true){ //Funcion para agregar graficas
                let labels = [];
                let info = [];
                let female = [];
                let male = [];
                items.forEach(item => {

                    let palabra = typeof item[title] == 'string' ? item[title].toLowerCase() : item[title];
                    let newString = typeof item[title] == 'string' ? palabra[0].toUpperCase() + palabra.slice(1) : palabra;
                    labels.push(newString);
                    info.push(item.total);

                    if(typeof item?.female == 'number')
                        female.push(item.female);

                    if(typeof item?.male == 'number')
                        male.push(item.male);
                });
                let data = {
                    labels: labels,
                    datasets: [],
                    scaleStartValue : 0,
                }

                if(flagTotal){
                    data.datasets.push({
                        data: info,
                        label: 'Total',
                        backgroundColor: '#082A44',
                        hoverBackgroundColor: '#3D9EE8',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    })
                }

                if(female.length > 0)
                    data.datasets.push({
                        data: female,
                        label: 'Femenino',
                        backgroundColor: '#EA5771',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    });
                
                if(male.length > 0)
                    data.datasets.push({
                        data: male,
                        label: 'Masculino',
                        backgroundColor: '#1E88E5',
                        borderColor: 'rgba(41, 98, 255, 1)',
                        hoverBackgroundColor: 'rgba(41, 98, 255, 1)',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    });
                return data;
            },
            rangeAge(items, title, flagTotal = true){ //Funcion para agregar graficas
                let labels = [];
                let info = [];
                let famela = [];
                let male = [];

                items.forEach(item => {

                    let palabra = typeof item.titulo == 'string' ? item.titulo.toLowerCase() : title;
                    labels.push(palabra);
                    info.push(item.total);

                    if(typeof item?.famela == 'number')
                        famela.push(item.famela);

                    if(typeof item?.male == 'number')
                        male.push(item.male);
                });

                console.log(famela)

                let data = {
                    labels: labels,
                    datasets: [],
                    scaleStartValue : 0,
                }

                if(flagTotal){
                    data.datasets.push({
                        data: info,
                        label: 'Total',
                        backgroundColor: '#082A44',
                        hoverBackgroundColor: '#3D9EE8',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    })
                }

                if(famela.length > 0)
                    data.datasets.push({
                        data: famela,
                        label: 'Femenino',
                        backgroundColor: '#EA5771',
                        borderWidth: 1,
                        hoverBorderWidth: 2,    
                    });
                
                if(male.length > 0)
                    data.datasets.push({
                        data: male,
                        label: 'Masculino',
                        backgroundColor: '#1E88E5',
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

    .md-button, .md-button-clean{ background-color: white; }

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
    .color-g { color: #8a8787 }

    @media (max-width: 320px) { .card-icon{ display: none; } }
</style>