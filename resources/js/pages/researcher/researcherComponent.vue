<template>
    <!--div class="container">
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
            <table>
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
            </table>
            <table>
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
                    </tr>
                    <tr>
                        <td>Maxima</td>
                    </tr>
                    <tr>
                        <td>Minima</td>
                    </tr>
                   
                    <tr v-for="(averageAge, index) in averageAge" :key="index">
                        <td>{{averageAge.total}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div-->
    <div class="margin-x">
    <div class="content bg">
		<div class="row">
			<div class="col s12">
                <br><br>
				<h5 class="black-text center principal-title">
                    Indicador de Investigadoras e Investigadores registrados en el Programa Nacional de Investigadores
                </h5>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col s3"></div>
				<div class="col s12 m7">
					<div class="card horizontal">
						<div class="card-image">
							<img class="icon-total-register" src="images/registro.svg">
						</div>
						<div class="card-stacked">
							<div class="card-content">
								<h5>Total registrados</h5>
							</div>
							<div class="card-action">
								<h2 class="total-register">{{total_investigators}}</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s4">
				<div class="card card-bg black-text container-fm" style="height: 450px;">
					<div class="card-content center">
                        <img class="icon-fm" src="images/genero-color.png" style="width: 100px">
						<h4>Mujeres:</h4>
						<h5>{{investigators_womens}}</h5>
						
						<h4>Hombres:</h4>
						<h5>{{investigators_mens}}</h5>
					</div>
				</div>
			</div>
			<div class="col s8">
				<div class="row">
					<div class="col s12">
						<div class="card card-bg black-text" >
							<div class="card-content center">
                                <span class="card-title">Investigadores por rango de edad</span>
                                <Bar :chart-data="datacollectionn" :height="250"></Bar>
							</div>
						</div>
					</div>					 
				</div>
			</div>
            <div class="row">
					<div class="col s12">
						<div class="card card-bg">
							<div class="card-content center">
                                <span class="card-title">Investigadores por estados</span>
                               <Bar :chart-data="datacollection" :height="250"></Bar>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s6">
						<div class="card card-bg">
							<div class="card-content">
                                <table class="responsive-table">
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
                                </table>
							</div>
						</div>
					</div>
					<div class="col s6">
						<div class="card card-bg">
							<div class="card-content">
                                <table class="responsive-table">
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
		    </div>
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
                averageAge: [],

                proFeme: '',
                proMasc: '',
                proTotal: '',

                minFeme: '',
                minMasc: '',
                minTotal: '',

                maxFeme: '',
                maxMasc: '',
                maxTotal: '',

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
                                label: 'Total investigadores por estado',
                                backgroundColor: '#1976d2',
                                data: num
                            }]
                        }
                        this.profesions = res.data.groupProfesion;
                        


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

                        console.log(this.averageAge);

                        this.proMasc = this.averageAge.promedio.masculino
                        this.proFeme = this.averageAge.promedio.femenino
                        this.proTotal = this.averageAge.promedio.total

                        this.minMasc = this.averageAge.minima.masculino
                        this.minFeme = this.averageAge.minima.femenino
                        this.minTotal = this.averageAge.minima.total

                        this.maxMasc = this.averageAge.maxima.masculino
                        this.maxFeme = this.averageAge.maxima.femenino
                        this.maxTotal = this.averageAge.maxima.total                                            
                    })
                    .catch(err => {
                        console.log(err);  
                    })
            }
        }
    }
</script>
<style>
*{
    color: black;
}
.total-register{
	font-size: 40px;
	margin-left: 55px;
	margin-top: -10px;
}
.icon-total-register{
	margin-top: 40px;
	margin-left: 12px;
	width: 110px;
	height: 110px;
}

.margin-x{
    margin: 0 50px
}
</style>
