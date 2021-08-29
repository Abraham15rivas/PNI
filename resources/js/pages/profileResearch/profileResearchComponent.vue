<template>
    <div class="margin-x">
        <loader :load="load" />
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
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('academicLevel', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content center" ref="academicLevel">
                        <span class="card-title title-card">Distribución de Investigadores por Nivel Académico</span>
                        <bar-charts v-if="show.academicLevel" :chartdata="academicLevel" :height="300"></bar-charts>
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
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('typeInvestigation', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="typeInvestigation">
                        <span class="card-title title-card">Cantidad de Investigaciones por Tipo de Investigación</span>
                        <horizontalBar-charts  v-if="show.typeInvestigation" :chartdata="typeInvestigation" :height="300"></horizontalBar-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('lineInvestigation', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="lineInvestigation">
                        <span class="card-title title-card" >Cantidad de Investigaciones por Línea de Investigación</span>
                        <horizontalBar-charts v-if="show.lineInvestigation" :chartdata="lineInvestigation" :height="300" ></horizontalBar-charts>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('typeInstitution', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="typeInstitution">
                        <span class="card-title title-card">Distribución de las Investigaciones por Tipo de Institución</span>
                        <doughnut-charts v-if="show.typeInstitution" :chartdata="typeInstitution" :height="300"></doughnut-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('timeInvestigation', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="timeInvestigation">
                        <span class="card-title title-card" >Distribución de los Investigadores por Tiempo de Investigación</span>
                       <bar-charts v-if="show.timeInvestigation" :chartdata="timeInvestigation" :height="300"></bar-charts>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import jsPDF from 'jspdf'
import 'jspdf-autotable'

export default {
    data(){
        return {
            // Image for pdf
            canvas: null,

            load: false,// Opciones Predefinidas
            options: {
                legend:  { align: "end" },
                element: { radius: 20 }
            },
            backgroundColor: [
                '#082A44', '#3D9EE8', '#9ECEF4',
                '#10E7D9', '#24D8A0', '#0D426B', 
                '#1D4C7A', '#5194D6', '#2DA8C8',
                '#10E7D9', '#1D4C7A', '#1781A1'
            ],
            borderColor: [
                '#2DA8C8', '#00B0F0', '#24D8A0', 
                '#7AE9C6', '#0EE3D7', '#001E5E', 
                '#52C3E3', '#082A44', '#3D9EE8', 
                '#9ECEF4','#0D426B','#1D4C7A'
            ],

            backgroundColor1: '#082A44',

            profileResearcher: Number, //Cantidad de Perfil del investigador

            profileResearch: Number, //Cantidad de Perfil del investigacion

            academicLevel: {}, //Nivel Academico

            timeInvestigation: {}, //Tiempo de Investigacion
            
            typeInvestigation: {}, //Tipo de Investigacion

            typeInstitution: {}, //Tipo de Institucion

            lineInvestigation: {}, //linea de Investigacion
            
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
    beforeMount () {
        this.load = true
    },
    async mounted() {
        const url = 'statistics/investigators/profile';
        axios.get(url)
            .then(res => {
                if(res.statusText === "OK"){
                    
                    this.profileResearcher = res.data.total_profiles; //Cantidad de Perfil del investigador
                    this.show.profileResearcher = this.profileResearcher ? true : false;

                    this.profileResearch = res.data.total_profiles_investigations; //Cantidad de Perfil del investigacion
                    this.show.profileResearch = this.profileResearch ? true : false;

                    //Nivel Academico
                    this.academicLevel = this.groupInv(res.data.academic_levels, 'academic_level', 'Investigadores por Nivel Académico', this.backgroundColor1);
                    this.show.academicLevel = true;

                    //Tipo de Investigacion
                    this.typeInvestigation = this.groupInv(res.data.investigations_type, 'type_investigation', 'Tipo de Investigación', this.backgroundColor1);
                    this.show.typeInvestigation = true;

                    //linea de Investigacion
                    this.lineInvestigation = this.groupInv(res.data.investigations_line, 'line_investigation', 'Líneas de Investigación', this.backgroundColor1);
                    this.show.lineInvestigation = true;

                    //Tipo de Institucion
                    this.typeInstitution = this.groupInv(res.data.institutions_type, 'institution_type', 'Tipo de institución', false);
                    this.show.typeInstitution = true;

                    //Tiempo de Investigacion
                    this.timeInvestigation = this.groupInv(res.data.investigations_time, 'investigation_time', 'Tiempo de Investigación', this.backgroundColor1);
                    this.show.timeInvestigation = true;

                    setTimeout(() => {
                        this.load = false
                    }, 5000) 
                }
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        async createPDF(graph, orientation, x, y, width, height, table = false) {
            const doc = new jsPDF({ orientation })
            const data = this[graph]

            if (data.datasets != undefined && data.datasets.length > 0 || table) {
                const el = this.$refs[graph]
                const options = {
                    type: 'dataURL'
                }
                this.canvas = await this.$html2canvas(el, options)

                doc.addImage(this.canvas, 'PNG', x, y, width, height)
                doc.save('reporte.pdf')
            }

            if (this.canvas) {
                this.canvas = null
            }
        },
        groupInv(items, title, label, color){
            let labels = [];
            let info = []

            if (label != 'Tiempo de Investigación') {
                items.sort((a, b) => a.total - b.total).reverse()
            } else  {
                items.sort((a, b) => a.id - b.id)
            }

            items.forEach(item => {
                let palabra = item[title].toLowerCase();
                labels.push(palabra[0].toUpperCase() + palabra.slice(1));
                info.push(item.total);
            });

            let data = {
                labels: labels,
                datasets: [{
                    data: info,
                    label: label,
                    backgroundColor: color ? color : this.backgroundColor,
                    borderColor: color ? color : this.borderColor,
                    hoverBackgroundColor: color ? color : this.borderColor,
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

.separate { margin: 48px 64px; }

.margin-x{
    margin: 0 50px;
    padding-top: 32px;
}


</style>
