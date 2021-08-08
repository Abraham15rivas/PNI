<template>
    <div class="margin-x">
        <div class="row">
            <div class="col s12">
                <h5 class="center-align" >Indicadores Sobre el Interés de Investigación e Investigaciones por Tipo de Institución</h5>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Cantidad de Investigadores por Interés de Investigación</span>
                        <horizontalBar-charts  v-if="loadedInt" :chartdata="interest" :height="325"></horizontalBar-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Distribución de las Investigaciones por Tipo de Institución</span>
                        <doughnut-charts v-if="loadedIns" :chartdata="institution" :height="300"></doughnut-charts>
                    </div>
                </div>                
            </div>
             <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center">Modo de Investigación que Realizan los Investigadores e Investigadoras</span>
                        <horizontalBar-charts v-if="loadedModeInv" :chartdata="modeInv" :height="300"></horizontalBar-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center" >Tipo de Investigación actual que realizan los Investigadores e Investigadoras</span>
                        <horizontalBar-charts v-if="loadedAct" :chartdata="actualInt" :height="180"></horizontalBar-charts>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12">
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
                                    <td class="td-title">{{ item.titulo }}</td>
                                    <td>{{ item.masculino }}</td>
                                    <td>{{ item.femenino }}</td>
                                    <td>{{ item.total }}</td>
                                </tr>
                            </tbody>
                        </table>
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
           
            institution: {}, //Grupo de institucion 
            loadedIns: false,

            interest: {}, //Grupo de Interes
            dataInterest: {},
            loadedInt: false,

            actualInt: {}, //Grupo de Interes
            loadedAct: false,

            modeInv: {}, //Como investiga
            loadedModeInv: false,

            groups: {}, //Grupos
        }
    },
    async mounted () {
        const url = 'statistics/investigators/interest';
        let dataInterest;
        let filter;
        axios.get(url)
            .then(res => {

                dataInterest = res.data.groupInterest;
                filter = dataInterest.filter( element => {
                    return element.total > 0
                });
                
                this.institution = this.groupInstitution(res.data.groupInstitution);
                this.interest = this.groupInterest(filter);
                this.actualInt = this.groupActualInt(res.data.actualInvestigation);
                this.modeInv = this.groupInv(res.data.groupModeInvestigation, 'titulo');
                this.loadedModeInv = this.modeInv != {} ? true : false;
                this.groups = res.data.allGroups;

                if (this.groups.length > 0) {
                    this.filterForGroup(this.groups, dataInterest)
                }
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        filterForGroup(group, data) {
            data.forEach(element => {
                group.forEach(ele => {
                    if (element.grupo == ele.title) {
                        ele.values.push(element)
                    }
                });
            });
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
        groupInterest(items){
            
            let labels = [];
            let info = [];
            let content = [];

            console.log(items)

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
                        label: 'Cantidad de investigaciones ',
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
                datasets: [{
                    data: info,
                    label: 'Cantidad total de investigaciones',
                    backgroundColor: this.backgroundColor,
                    borderColor: this.borderColor,
                    hoverBackgroundColor: this.borderColor,
                    borderWidth: 1,
                    hoverBorderWidth: 2
                }]
            }
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
                    backgroundColor: '#082A44',
                    hoverBackgroundColor: '#3D9EE8',
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
</style>