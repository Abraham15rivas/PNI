<template>
    <div class="margin-x">
        
        <div class="row">
            <div class="col s12">
                <h5 class="black-text center">
                    Indicador del Perfil de los Investigadores e Investigaciones Registradas
                </h5>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m6 offset-m3 l6 offset-l3">
                <div class="card horizontal">
                    <div class="card-image card-icon">
                        <img class="icon-total-register" src="images/registro.svg">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <h5 class="title-card center-align">Total Registrados en el Perfil del Investigador</h5>
                        </div>
                        <div class="card-action" v-if="show.profileResearcher">
                            <h2 class="total-register">{{profileResearcher}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card">
                    <!-- <div class="card-content center blue lighten-5"> -->
                    <div class="card-content center">
                        <span class="card-title title-card">Nivel Académico</span>
                        <bar-charts v-if="show.academicLevel" :chartdata="academicLevel" :height="150"></bar-charts>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <hr class="separate">
            </div>
        </div>
        
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card horizontal">
                    <div class="card-image card-icon">
                        <img class="icon-total-register" src="images/registro.svg">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <h5 class="title-card">Total Registrados en el Perfil de la Investigación</h5>
                        </div>
                        <div class="card-action" v-if="show.profileResearch">
                            <h2 class="total-register">{{profileResearch}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title title-card">Tipo de Investigación</span>
                        <bar-charts  v-if="show.typeInvestigation" :chartdata="typeInvestigation" :height="200"></bar-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title title-card" >Línea de Investigación</span>
                        <horizontalBar-charts v-if="show.lineInvestigation" :chartdata="lineInvestigation" :height="200" ></horizontalBar-charts>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title title-card">Tipo de Institución</span>
                        <pie-charts v-if="show.typeInstitution" :chartdata="typeInstitution" :height="200"></pie-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title title-card" >Tiempo de Investigación</span>
                       <bar-charts v-if="show.timeInvestigation" :chartdata="timeInvestigation" :height="200"></bar-charts>
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
             load: false,
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
                '#082A44',
                '#3D9EE8',
                '#9ECEF4',
                '#10E7D9',
                '#24D8A0',
                '#0D426B',
                '#1D4C7A',
                '#5194D6',
                '#2DA8C8',
                '#10E7D9',
                '#1D4C7A',
                '#1781A1'
            ],
            borderColor: [
                '#2DA8C8', 
                '#00B0F0',   
                '#24D8A0', 
                '#7AE9C6', 
                '#0EE3D7',  
                '#001E5E', 
                '#52C3E3', 
                '#082A44',
                '#3D9EE8',
                '#9ECEF4',
                '#0D426B',
                '#1D4C7A'
            ],

            //Cantidad de Perfil del investigador
            profileResearcher: Number,

            //Cantidad de Perfil del investigacion
            profileResearch: Number,

            //academic_levels
            //Nivel Academico
            academicLevel: {},
            
            //investigations_time
            //Tiempo de Investigacion
            timeInvestigation: {},


            //type_investigation
            //Tipo de Investigacion
            typeInvestigation: {},

            //institutions_type
            //Tipo de Institucion
            typeInstitution: {},

            //investigations_line
            //linea de Investigacion
            lineInvestigation: {},
            
            show:{
                profileResearcher: false,
                profileResearch: false,
                academicLevel: false,
                timeInvestigation: false,
                typeInvestigation: false,
                typeInstitution: false,
                lineInvestigation: false,
            }


        }
    },
    async mounted() {
        const url = 'statistics/investigators/profile';
        axios.get(url)
            .then(res => {
                if(res.statusText === "OK"){
                    //Cantidad de Perfil del investigador
                    this.profileResearcher = res.data.total_profiles;
                    this.show.profileResearcher = this.profileResearcher ? true : false;

                    //Cantidad de Perfil del investigacion
                    this.profileResearch = res.data.total_profiles_investigations;
                    this.show.profileResearch = this.profileResearch ? true : false;

                    //Nivel Academico
                    this.academicLevel = this.groupInv(res.data.academic_levels, 'academic_level');
                    this.show.academicLevel = true;

                    //Tipo de Investigacion
                    this.typeInvestigation = this.groupInv(res.data.investigations_type, 'type_investigation');
                    this.show.typeInvestigation = true;

                    //linea de Investigacion
                    this.lineInvestigation = this.groupInv(res.data.investigations_line, 'line_investigation');
                    this.show.lineInvestigation = true;

                    //Tipo de Institucion
                    this.typeInstitution = this.groupInv(res.data.institutions_type, 'institution_type');
                    this.show.typeInstitution = true;

                    //Tiempo de Investigacion
                    this.timeInvestigation = this.groupInv(res.data.investigations_time, 'investigation_time');
                    this.show.timeInvestigation = true;
                }
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        groupInv(items, title){
            let labels = [];
            let info = []

            items.forEach(item => {
                let palabra = item[title].toLowerCase();
                labels.push(palabra[0].toUpperCase() + palabra.slice(1));
                info.push(item.total);
            });
            let data = {
                labels: labels,
                datasets: [{
                    data: info,
                    label: 'Series 1',
                    backgroundColor: this.backgroundColor,
                    borderColor: this.borderColor,
                    hoverBackgroundColor: this.borderColor,
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                    
                }],
            }
            return data;
        }
    },

}
</script>
<style scoped>
.total-register{
	font-size: 40px;
    margin-top: -8px;
    margin-bottom: 0px;
    text-align: center;
}

.icon-total-register{
	width: 110px;
	height: 110px;
}

.card-icon {
    background: #e3f2fd;
    display: flex;
    align-items: center;
    padding: 0px 8px 0px 16px;
}

.title-card {
    text-align: center;
    margin-top: 0px;
}

.separate {
    margin: 48px 64px;
}

.margin-x{
    margin: 0 50px;
    padding-top: 32px;
}

.card:hover {
    background: #e3f2fd;
}
</style>
