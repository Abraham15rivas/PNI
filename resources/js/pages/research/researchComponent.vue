<template>
    <div class="margin-x">
        <loader :load="load" /> 
        <div class="row">
            <div class="col s12">
                <h5 class="center-align" >Indicadores Sobre el Interés de Investigación e Investigaciones por Tipo de Institución</h5>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('groupSelectedInterest', 'landscape', 5, 0, 260, 200)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="groupSelectedInterest">
                        <span class="card-title center" >Cantidad de Investigadores por Interés de Investigación</span>
                         <div class="row" style="padding: 0px 24px">
                            <div class="col s12" v-if="groups.length > 0">
                                <md-field>
                                    <label for="stateAge">Seleccione un Grupo</label>
                                    <md-select v-model="groupSelected" name="stateAge" id="stateAge" v-on:md-selected="changeGroup()">
                                        <md-option v-for="(group, index) of groups" :key="index" :value="group.title">{{group.title | formatTitle}}</md-option>
                                    </md-select>
                                </md-field>
                            </div>
                        </div>
                        <horizontalBar-charts  v-if="loadedInt" :chartdata="groupSelectedInterest" :height="200"></horizontalBar-charts>
                        <span v-else class="prespan">
                            <div class="preloader"></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('institution', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="institution">
                        <span class="card-title center">Distribución de las Investigaciones por Tipo de Institución</span>
                        <doughnut-charts v-if="loadedIns" :chartdata="institution" :height="300"></doughnut-charts>
                    </div>
                </div>                
            </div>
             <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('modeInv', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="modeInv">
                        <span class="card-title center">Modo de Investigación que Realizan los Investigadores e Investigadoras</span>
                        <doughnut-charts v-if="loadedModeInv" :chartdata="modeInv" :height="300"></doughnut-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('groupSelectedInterest2', 'landscape', 5, 0, 260, 200)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="groupSelectedInterest2">
                        <span class="card-title center" >Tipo de Investigación actual que realizan los Investigadores e Investigadoras</span>
                        <div class="row" style="padding: 0px 24px">
                            <div class="col s12" v-if="groups2.length > 0">
                                <md-field>
                                    <label for="stateAge">Seleccione un Grupo</label>
                                    <md-select v-model="groupSelected2" name="stateAge" id="stateAge" v-on:md-selected="changeGroup2()">
                                        <md-option v-for="(group, index) of groups2" :key="index" :value="group.title">{{group.title | formatTitle}}</md-option>
                                    </md-select>
                                </md-field>
                            </div>
                        </div>
                        <horizontalBar-charts v-if="loadedAct" :chartdata="groupSelectedInterest2" :height="180"></horizontalBar-charts>
                        <span v-else class="prespan">
                            <div class="preloader"></div>
                        </span>
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

            load: false,
            // Opciones Predefinidas
            options: {
                legend: { align: "end" },
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
                '#9ECEF4', '#0D426B', '#1D4C7A'
            ],
            //COLORES DE GRUPOS-LINEAS DE INVESTIGACÓN
            colorGroup: [
                {
                    title: 'AGUA',
                    color: '#52C3E3'
                },
                {
                    title: 'CAMBIO_CLIMÁTICO',
                    color: '#24D8A0'
                },
                {
                    title: 'MINERIA_GEOLOGÍA',
                    color: '#5194D6'
                },
                {
                    title: 'COVID-19',
                    color: '#3D9EE8'
                },
                {
                    title: 'NUTRICIÓN',
                    color: '#7AE9C6'
                },
                {
                    title: 'AREA_OCDE',
                    color: '#9ECEF4'
                },
                {
                    title: 'CIENCIAS_SOCIALES',
                    color: '#10E7D9'
                },
                {
                    title: 'ENERGÍA_ELÉCTRICA',
                    color: '#FDFA3F'
                },
                {
                    title: 'TRANSPORTE',
                    color: '#1D4C7A'
                },
                {
                    title: 'AGROALIMENTARIO',
                    color: '#1781A1'
                },
                {
                    title: 'PESCA_ACUICULTURA',
                    color: '#2DA8C8'
                },
                {
                    title: 'SISMOLOGÍA',
                    color: '#001E5E'
                },
                {
                    title: 'PETRÓLEO',
                    color: '#C51818'
                },
            ],
           
            institution: {}, //Grupo de institucion 
            loadedIns: false,

            dataInterest: {},
            loadedInt: false,

            actualInt: {}, //Grupo de Interes
            loadedAct: false,

            modeInv: {}, //Como investiga
            loadedModeInv: false,

            groups: {}, //Grupos
            groupSelected: {}, // Titulo de grupo seleccionado
            groupSelectedInterest: {}, // Grupo seleccionado

            groups2: {}, //Grupos
            groupSelected2: {}, // Titulo de grupo seleccionado
            groupSelectedInterest2: {} // Grupo seleccionado
        }
    },
    filters: {
        formatTitle(value) {
            let word = `${value.charAt(0).toUpperCase()}${value.slice(1).toLowerCase()}`
            let wordSeparator = word.split('_')

            if (wordSeparator.length > 1) {
                word = `${wordSeparator[0]} ${wordSeparator[1]}`
            }

            return word
        }
    },
    beforeMount () {
        this.load = true
    },
    async mounted () {
        const url = 'statistics/investigators/interest';
        axios.get(url)
            .then(res => {
                this.dataInterest = res.data.groupInterest;
                this.actualInt = res.data.actualInvestigation;

                this.institution = this.groupInstitution(res.data.groupInstitution);
                this.modeInv = this.groupInv(res.data.groupModeInvestigation, 'titulo');

                this.loadedModeInv = this.modeInv != {} ? true : false;
                this.groups = res.data.allGroups;
                this.groups2 = JSON.parse(JSON.stringify(res.data.allGroups));

                if (this.groups.length > 0) {
                    let group = this.filterForGroup(this.groups, this.dataInterest)
                    this.groupSelectedInterest = this.groupInterest(group[0].values, group[0].title);
                    this.groupSelected = group[0].title
                }

                if (this.groups2.length > 0) {
                    let group2 = this.filterForGroup(this.groups2, this.actualInt)
                    this.groupSelectedInterest2 = this.groupActualInt(group2[0].values, group2[0].title);
                    this.groupSelected2 = group2[0].title
                }

                setTimeout(() => {
                    this.load = false
                }, 5000)
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
        changeGroup2() {
            let searchGroup = this.groups2.filter(element => {
                if (element.title === this.groupSelected2) {
                    return element
                }
            })

            this.loadedAct = false;
            
            setTimeout(() => {
                this.groupSelectedInterest2 = this.groupActualInt(searchGroup[0].values, searchGroup[0].title);
            }, 5000)
        },
        changeGroup() {
            let searchGroup = this.groups.filter(element => {
                if (element.title === this.groupSelected) {
                    return element
                }
            })

            this.loadedInt = false;
            
            setTimeout(() => {
                this.groupSelectedInterest = this.groupInterest(searchGroup[0].values, searchGroup[0].title);
            }, 5000)
        },
        filterForGroup(group, data) {
            data.forEach(element => {
                group.forEach(ele => {
                    if (element.grupo === ele.title) {
                        ele.values.push(element)
                    }
                })
            })
            return group
        },
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
        groupInterest(items, title, flagTotal = true){            
            let labels = [];
            let info = [];
            let female = [];
            let male = [];
            let grupo = {
                color: '#082A44'
            }

            items.sort((a, b) => a.total - b.total).reverse()

            items.forEach(item => {
                if(item['titulo'] != "TOTALES"){                    
                    item.titulo = item.titulo.toLowerCase();
                    labels.push(item.titulo[0].toUpperCase() + item.titulo.slice(1));
                    info.push(item.total);
                    if (item.total > 0) {
                        female.push(item.femenino)
                        male.push(item.masculino)
                    }
                }
            });
            
            grupo = this.colorGroup.find((grupo) => {
                if (grupo.title === title)
                    return grupo
            })

            let data = {
                labels: labels,
                datasets: [],
                scaleStartValue : 0,
            }

            if(flagTotal){
                data.datasets.push({
                    data: info,
                    label: 'Cantidad de Investigaciones',
                    backgroundColor: grupo.color,
                    borderColor: grupo.color,
                    hoverBackgroundColor: grupo.color,
                    borderWidth: 1,
                    hoverBorderWidth: 2,    
                })
            }

            if(female.length > 0)
                data.datasets.push({
                    data: female,
                    label: 'Mujeres',
                    backgroundColor: '#EA5771',
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                });
            
            if(male.length > 0)
                data.datasets.push({
                    data: male,
                    label: 'Hombres',
                    backgroundColor: '#1E88E5',
                    borderColor: 'rgba(41, 98, 255, 1)',
                    hoverBackgroundColor: 'rgba(41, 98, 255, 1)',
                    borderWidth: 1,
                    hoverBorderWidth: 2, 
                });

            this.loadedInt = true;
            return data;
        },        
        groupActualInt(items, title, flagTotal = true){            
            let labels = [];
            let info = [];
            let female = [];
            let male = [];
            let grupo = {
                color: '#082A44'
            }

            items.sort((a, b) => a.total - b.total).reverse()

            items.forEach(item => {
                if(item['titulo'] != "TOTALES"){                    
                    item.titulo = item.titulo.toLowerCase();
                    labels.push(item.titulo[0].toUpperCase() + item.titulo.slice(1));
                    info.push(item.total);
                    if (item.total > 0) {
                        female.push(item.femenino)
                        male.push(item.masculino)
                    }
                }
            });
            
            grupo = this.colorGroup.find((grupo) => {
                if (grupo.title === title)
                    return grupo
            })

            let data = {
                labels: labels,
                datasets: [],
                scaleStartValue : 0,
            }

            if(flagTotal){
                data.datasets.push({
                    data: info,
                    label: 'Cantidad de total Investigaciones actuales',
                    backgroundColor: grupo.color,
                    borderColor: grupo.color,
                    hoverBackgroundColor: grupo.color,
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                })
            }

            if(female.length > 0)
                data.datasets.push({
                    enabled: false,
                    data: female,
                    label: 'Mujeres',
                    backgroundColor: '#EA5771',
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                });
            
            if(male.length > 0)
                data.datasets.push({
                    enabled: false,
                    data: male,
                    label: 'Hombres',
                    backgroundColor: '#1E88E5',
                    borderColor: 'rgba(41, 98, 255, 1)',
                    hoverBackgroundColor: 'rgba(41, 98, 255, 1)',
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                });

            this.loadedAct = true;
            return data;
        },
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
                    label: 'Modo de Investigación',
                    backgroundColor: this.backgroundColor,
                    hoverBackgroundColor: this.borderColor,
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                    
                }],
            }
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

.td-title{
    color: #1E88E5;
    cursor: pointer;
}

.td-title:hover{ color: #000 }

.card .card-content {
    cursor: pointer;
}

/* Preloader */
.prespan {
  height: 150px;
  /*IMPORTANTE*/
  display: flex;
  justify-content: center;
  align-items: center;
}
.preloader {
  width: 70px;
  height: 70px;
  border: 10px solid #eee;
  border-top: 10px solid #666;
  border-radius: 50%;
  animation-name: girar;
  animation-duration: 2s;
  animation-iteration-count: infinite;
  animation-timing-function: linear;
}
@keyframes girar {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

</style>