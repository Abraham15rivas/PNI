<template>
    <div class="margin-x">
        <loader :load="load" />
        <span ref="header">
            <div class="row">
                <div class="col s12">
                    <h5 class="center-align" >Indicador del Módulo de la Investigación Actual</h5>
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
                                <h6 class="center-align title-card">Total Registrados en el Módulo de la Investigación</h6>
                            </div>
                            <div class="card-action">
                                <h2 class="total-register">{{total_investigation}}</h2>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('institution', 'landscape', 10, 20, 150, 160, false, 'header')">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="institution">
                        <span class="card-title center">Distribución de las Investigaciones por Tipo de Institución</span>
                        <doughnut-charts v-if="loadedIns" :chartdata="institution" :height="325"></doughnut-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('investigation_type', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="investigation_type">
                        <span class="card-title center" >Cantidad de Investigaciones por Tipo de Investigación</span>
                        <horizontalBar-charts v-if="loadedInvType" :chartdata="investigation_type" :height="325"></horizontalBar-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
            <div class="card">
                <span class="content-button-pdf">
                    <button class="btn button-pdf" title="PDF" @click="createPDF('investigation_line', 'portrait', 10, 10, 190, 220)">
                        <i class="material-icons">picture_as_pdf</i>
                    </button>
                </span>
                <div class="card-content" ref="investigation_line">
                    <span class="card-title center">Cantidad de Investigaciones por Línea de Investigación</span>
                    <horizontalBar-charts v-if="loadedInvLine" :chartdata="investigation_line" :height="300"></horizontalBar-charts>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('phase_investigation', 'landscape', 80, 30, 145, 140)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="phase_investigation">
                        <span class="card-title center">Distribución de Investigaciones por Fase</span>
                        <doughnut-charts v-if="loadedPhaseInv" :chartdata="phase_investigation" :height="300"></doughnut-charts>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <span class="content-button-pdf">
                        <button class="btn button-pdf" title="PDF" @click="createPDF('investigation_time', 'landscape', 80, 12, 150, 160)">
                            <i class="material-icons">picture_as_pdf</i>
                        </button>
                    </span>
                    <div class="card-content" ref="investigation_time">
                        <span class="card-title center" >Distribución de Investigadores por Tiempo de Investigación</span>
                        <bar-charts v-if="loadedTimeInv" :chartdata="investigation_time" :height="300"></bar-charts>
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
        data() {
            return {
                // Image for pdf
                canvas: null,

                load: false,
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
                '#1781A1',
                '#082A44',
                '#3D9EE8',
                '#9ECEF4',
                '#10E7D9'
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
                '#1D4C7A',
                '#2DA8C8',
                '#00B0F0',
                '#24D8A0',
                '#7AE9C6'
            ],

                total_investigation: 0,

                //Group Institution
                institution: {},
                loadedIns: false,

                //Group investigation type
                investigation_type: {},
                loadedInvType: false,

                //Group investigation line
                investigation_line: {},
                loadedInvLine: false,

                //Group phase investigation
                phase_investigation: {},
                loadedPhaseInv: false,

                //Group time investigation
                investigation_time: {},
                loadedTimeInv: false,                
            }
        },
        beforeMount () {
            this.load = true
        },
        async mounted () {
            let url = 'statistics/investigators/current';
            axios.get(url)
                .then(res => {
                    this.total_investigation = res.data.total_investigation;
                    this.institution = this.groupInstitution(res.data.groupInstitution);
                    this.investigation_type = this.groupInvestigationType(res.data.investigations_type);
                    this.investigation_line = this.groupInvestigationLine(res.data.investigations_line); 
                    this.phase_investigation = this.groupPhaseInvestigation(res.data.investigations_phase);
                    this.investigation_time = this.groupInvestigationsTime(res.data.investigations_time);

                    setTimeout(() => {
                        this.load = false
                    }, 5000) 
                })

        },
        methods: {
            async createPDF(graph, orientation, x, y, width, height, table = false, header = null) {
                const doc = new jsPDF({ orientation })
                const data = this[graph]

                if (data.datasets != undefined && data.datasets.length > 0 || table) {
                    if (header) {
                        const headerValue = this.$refs[header]
                        const canvasHeader = await this.$html2canvas(headerValue, options)
                        doc.addImage(canvasHeader, 'PNG', 160, 25, 140, 60)
                    }

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
            groupInstitution(items){
                let labels = [];
                let info = []

                items.forEach(item => {
                    item.institution_type = item.institution_type.toLowerCase();
                    let palabra = item.institution_type.split(' ');

                    if(palabra[0] === 'institucion' || palabra[0] === 'institución' ){
                        labels.push(palabra[1][0].toUpperCase() + palabra[1].slice(1));
                    }else{
                        labels.push(item.institution_type[0].toUpperCase() + item.institution_type.slice(1));
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
            groupInvestigationType(items){
                let labels = [];
                let info = [];
               
                items.sort((a, b) => a.total - b.total).reverse()

                items.forEach(item => {
                    if(item['type_investigation'] != "TOTALES"){                        
                        item.type_investigation = item.type_investigation.toLowerCase();
                        labels.push(item.type_investigation[0].toUpperCase() + item.type_investigation.slice(1)); 
                        info.push(item.total);
                    }
                });

                let data = {
                    labels: labels,
                    datasets: [
                        {
                            data: info,
                            label: 'Nº de Investigaciones',
                            backgroundColor: '#082A44',
                            hoverBackgroundColor: '#3D9EE8',
                            borderWidth: 1,
                            hoverBorderWidth: 2,
                            steppedLine: "middle"
                        }
                    ]
                }
                this.loadedInvType = true;
                return data;
            },
            groupInvestigationLine(items){
                let labels = [];
                let info = [];

                items.sort((a, b) => a.total - b.total).reverse()

                items.forEach(item => {
                    if(item['line_investigation'] != "TOTALES"){
                        item.line_investigation = item.line_investigation.toLowerCase();
                        labels.push(item.line_investigation[0].toUpperCase() + item.line_investigation.slice(1)); 
                        info.push(item.total);
                    }
                });

                let data = {
                    labels: labels,
                    datasets: [{
                        data: info,
                        label: 'Cantidad de Investigaciones',
                        backgroundColor: this.backgroundColor,
                        borderColor: this.borderColor,
                        hoverBackgroundColor: this.borderColor,
                        borderWidth: 1,
                        hoverBorderWidth: 2
                    }]
                }
                this.loadedInvLine = true;
                return data;
            },
            groupPhaseInvestigation(items){
                let labels = [];
                let info = [];

                items.forEach(item => {
                    if(item['phase_investigation'] != "TOTALES"){                        
                        item.phase_investigation = item.phase_investigation.toLowerCase();
                        labels.push(item.phase_investigation[0].toUpperCase() + item.phase_investigation.slice(1)); 
                        info.push(item.total);
                    }
                });

                let data = {
                    labels: labels,
                    datasets: [{
                        data: info,
                        label: 'Fase de la Investigación',
                        backgroundColor: this.backgroundColor,
                        hoverBackgroundColor: this.borderColor,
                        borderWidth: 1,
                        hoverBorderWidth: 2,
                        steppedLine: "middle"
                    }]
                }
                this.loadedPhaseInv = true;
                return data;
            },
            groupInvestigationsTime(items){
                let labels = [];
                let info = [];

                 items.sort((a, b) => a.total - b.total)

                items.forEach(item => {
                    if(item['investigation_time'] != "TOTALES"){                        
                        item.investigation_time = item.investigation_time.toLowerCase();
                        labels.push(item.investigation_time[0].toUpperCase() + item.investigation_time.slice(1)); 
                        info.push(item.total);
                    }
                });

                let data = {
                    labels: labels,
                    datasets: [{
                        data: info,
                        label: 'Tiempo de Investigación',
                        backgroundColor: '#082A44',
                        hoverBackgroundColor: '#3D9EE8',
                        borderWidth: 1,
                        hoverBorderWidth: 2,
                        steppedLine: "middle"
                    }]
                }
                this.loadedTimeInv = true;
                return data;
            }
        }
    }
</script>
<style scoped>
.margin-x{
    margin: 0 50px;
    padding-top: 32px;
}
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

</style>
