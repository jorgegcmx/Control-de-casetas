</div>


  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vuex@3.1.1/dist/vuex.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script type="text/javascript">
     
        Vue.component('casetas', {
                template://html
                    `
                <div>   
                   <button type="button" v-on:click="getCasetas" class="btn btn-block bg-gradient-primary btn-xs">+ Costo Diario</button>
                   <button type="button" v-on:click="cleard"  class="btn btn-block bg-gradient-danger btn-xs">-</button>          
                  
                   <div v-for="(itemm,key,index) in casetas" :key="key" >
                   
                   <ul class="list-group">
                         <li class="list-group-item d-flex justify-content-between align-items-center" 
                            v-if="itemm.Proyecto === proyecto">
                           <span class='badge bg-success'>Correcto</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Proyecto
                          <span class="badge badge-primary badge-pill">{{itemm.Proyecto}}</span>                                                  
                        </li>                       
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Almacen
                          <span class="badge badge-primary badge-pill">{{itemm.SiteID}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Articulo
                          <span class="badge badge-primary badge-pill">{{itemm.InvtID}}</span>
                        </li>                       
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Cantidad
                          <span class="badge badge-primary badge-pill">{{itemm.QtyAvail}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Costo Unitario
                          <span class="badge badge-primary badge-pill">$ {{itemm.AvgCost}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Descripción
                          <span class="badge badge-primary badge-pill">{{itemm.Descr}}</span>
                        </li>
                     </ul>                     
                    </div>                   
                </div>            
                `,
                props: ['id','proyecto']               
                ,
                 mounted() {                  
                },
                data() {
                    return {
                        casetas: []
                    }
                },
                methods: {
                    getCasetas: function () {
                        axios.get(`http://localhost:8000/CostoPollo/${this.id}`).then(response => {
                            this.casetas = response.data;  
                            //console.log(this.casetas);                         
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    cleard: function () {
                        axios.get(`http://localhost:8000/CostoPollo/0`).then(response => {
                            this.casetas = response.data;                           
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }

                }
            })

            
        Vue.component('carton', {
                template://html
                    `
                <div>  
                   <button type="button" v-on:click="getCartones" class="btn btn-block bg-gradient-primary btn-xs">+ Info carton</button>
                   <button type="button" v-on:click="cleardCartones"  class="btn btn-block bg-gradient-danger btn-xs">-</button>       
                                                      
                       <table class="table">
                       <thead>
                       <tr>
                       <th><small>Dias</small></th>
                       <th><small>LotesSalida</small></th>
                       <th><small>Pantalla</small></th>
                       <th><small>Modulo</small></th>
                       <th><small>Importe</small></th>
                       <th><small>Status</small></th>
                       <th></th>
                       <th><small>LoteAjuste</small> </th>
                       <th><small>Pantalla</small></th>
                       <th><small>Modulo</small></th>
                       <th><small>Importe</small></th>
                       <th><small>Status</small></th>
                       </tr>
                       </thead>                      
                       <tbody>                      
                        <tr v-for="(carton,key,index) in cartones" :key="key" >                      
                        <td><small>{{carton.Edad}}</small></td>
                        <td><small>{{carton.LoteConsAlimGas}}</small></td>               
                        <td><small>{{carton.PanSalida}}</small></td>
                        <td><small>{{carton.ModSalida}}</small></td>
                        <td><small>{{carton.Totalsalida}}</small></td>
                        <td><small>{{carton.StatusSalida}}</small></td>
                        <td><lotesalida ></lotesalida></td>
                        <td><small>{{carton.LoteAjusteMerma}}</small></td>
                        <td><small>{{carton.PantAjuste}}</small></td>
                        <td><small>{{carton.ModAjuste}}</small></td>
                        <td><small>{{carton.TotalAjuste}}</small></td>
                        <td><small>{{carton.StatusAjuste}}</small></td>
                                      
                        </tr>                       
                       </tbody>                      
                       </table>               
                                     
                </div>            
                `,
                props: ['idcaseta','annio','ciclo']               
                ,
                 mounted() {                  
                },
                data() {
                    return {
                        cartones: []
                    }
                },
                methods: {
                    getCartones: function () {
                        axios.get("http://localhost:8000/DetalleCarton/"+ this.idcaseta+"/"+ this.annio +"/"+this.ciclo+"").then(response => {
                            this.cartones = response.data;                                                    
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    cleardCartones: function () {
                        axios.get(`http://localhost:8000/DetalleCarton/0/0/0`).then(response => {
                          this.cartones = response.data;                           
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                }
            })

            Vue.component('lotesalida', {
                template://html
                    `
                <div>               
                <button class="btn btn-block bg-gradient-primary btn-xs">+</button>
               
                </div>            
                `,
                props: ['lote']               
                ,
                 mounted() {                  
                },
                data() {
                    return {
                        lote: []
                    }
                },
                methods: {
                    getloteSalida: function () {
                        axios.get("http://localhost:8000/Lote/"+ this.lote).then(response => {
                            this.lote = response.data;                                          
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    cleardloteSalida: function () {
                        axios.get(`http://localhost:8000/lote/0/`).then(response => {
                          this.lote = response.data;                           
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                }
            })


      new Vue({
        el: "#main"     
      });     
  </script>
</body>
</html>


