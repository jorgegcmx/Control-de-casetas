</div>


  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vuex@3.1.1/dist/vuex.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
  
    <script type="text/javascript">
     
        Vue.component('casetas', {
                template://html
                    `
                <div>   
                   <button type="button" v-on:click="getCasetas" class="btn btn-primary btn-xs">+ Costo Diario</button>
                   <button type="button" v-on:click="cleard"  class="btn btn-warning btn-xs">-</button>          
                  
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
                
                <div class="btn-group"> 
                <button type="button" v-on:click="getCartones" class="btn btn-primary btn-xs">+ Info carton</button>
                <button type="button" v-on:click="cleardCartones"  class="btn btn-warning btn-xs">-</button>
                </div>
                <table class="table">                    
                                            
                  <tbody v-for="(carton,key,index) in cartones" :key="key">                  
                        <tr>                                                                               
                        <td><small>dia </small><br><small>{{carton.Edad}}</small></td>
                        <td><small>lote Salida </small><br><small>{{carton.LoteConsAlimGas}}</small></td>               
                        <td><small>pantalla </small><br><small>{{carton.PanSalida}}</small></td>                        
                        <td><small>monto </small><br><small>{{carton.ModSalida}}</small></td>
                        <td><small>total </small><br><small>{{carton.Totalsalida}}</small></td>
                        <td><small>status </small><br><small>{{carton.StatusSalida}}</small></td> 
                        <td><small>lote Ajus </small><br><small>{{carton.LoteAjusteMerma}}</small></td>
                        <td><small>Pantalla </small><br><small>{{carton.PantAjuste}}</small></td>
                        <td><small>monto </small><br><small>{{carton.ModAjuste}}</small></td>
                        <td><small>total </small><br><small>{{carton.TotalAjuste}}</small></td>
                        <td><small>status </small><br><small>{{carton.StatusAjuste}}</small></td>    
                        <tr>
                        <td colspan="6">
                        <loteSalida :lote="carton.LoteConsAlimGas"  ></loteSalida>     
                        </td>                       
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

            Vue.component('loteSalida', {
                template://html
                 `
                <div>
                <div class="btn-group">                       
                <button type="button" class="btn btn-primary btn-xs" v-on:click="getloteSalida">+</button> 
                <button type="button" class="btn btn-warning btn-xs" v-on:click="cleardloteSalida">-</button>
                </div> 
                
                <table class="table" > 
                <tr>
               <td colspan="16"><small> Detalle de Lote de Salida </small></td>
                </tr>                              
                <tr v-for="(intran,key,index) in lotes"  style="background-color:lightyellow">                
                <td><small>{{intran.Crtd_User}}</small></td>
                <td><small>{{intran.ProjectID}}</small></td>
                <td><small>{{intran.InvtID}}</small></td>
                <td><small>{{intran.Qty}}</small></td>
                <td><small>{{intran.UnitPrice}}</small></td>
                <td><small>{{intran.TranAmt}}</small></td>
                <td><small>{{intran.TranDesc}}</small></td>
                <td><small>{{intran.TranType}}</small></td>
                <td><small>{{intran.WhseLoc}}</small></td>            
                <td><small>{{intran.COGSSub}}</small></td>
                <td><small>{{intran.InvtSub}}</small></td>
                <td><small>{{intran.InvtAcct}}</small></td>
                <td><small>{{intran.ExtCost}}</small></td>
                <td><small>{{intran.ReasonCd}}</small></td>
                <td><small>{{intran.SiteID}}</small></td>
                <td><small>{{intran.Sub}}</small></td>
                </tr>                
                </table>
                                     
                </div>            
                `,
                props: ['lote']                          
                ,
                 mounted() {                  
                },
                data() {
                    return {
                        lotes: []
                    }
                },
                methods: {
                    getloteSalida: function () {
                        axios.get("http://localhost:8000/DetalleSalida/"+ this.lote).then(response => {
                            this.lotes = response.data;                                          
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    cleardloteSalida: function () {
                        axios.get(`http://localhost:8000/DetalleSalida/0/`).then(response => {
                          this.lotes = response.data;                           
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                }
            })
           
            Vue.component('lotestranferencia', {
                template://html
                 `
                <div>
                <div class="btn-group">                       
                <button type="button" class="btn btn-primary btn-xs" v-on:click="getlotetrans">+</button> 
                <button type="button" class="btn btn-warning btn-xs" v-on:click="cleardlotetrans">-</button>
                </div> 
                
                <table class="table" >                                              
                <tr v-for="(intrantrans,key,index) in lotetrasarr" >         
                              
                <td><small>Cant: {{intrantrans.Cantidad}}</small></td>
                <td><small> Suntotal: {{intrantrans.Subtotal}}</small></td> 
                <td><small>Proyect: {{intrantrans.ProjectID}}</small></td>               
                </tr>                
                </table>
                                     
                </div>            
                `,
                props: ['lotetras']                          
                ,
                 mounted() {                  
                },
                data() {
                    return {
                        lotetrasarr: []
                    }
                },
                methods: {
                    getlotetrans: function () {
                        axios.get("http://localhost:8000/transferencia/"+ this.lotetras+"/II").then(response => {
                            this.lotetrasarr = response.data;    
                            console.log(this.lotetrasarr)                                      
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    cleardlotetrans: function () {
                        axios.get(`http://localhost:8000/transferencia/0/0`).then(response => {
                          this.lotetrasarr = response.data;                           
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                }
            })

            Vue.component('lotestranferencia_entrada', {
                template://html
                 `
                <div>
                <div class="btn-group">                       
                <button type="button" class="btn btn-primary btn-xs" v-on:click="getlotetrans">+</button> 
                <button type="button" class="btn btn-warning btn-xs" v-on:click="cleardlotetrans">-</button>
                </div> 
                
                <table class="table" >                                              
                <tr v-for="(intrantrans,key,index) in lotetrasarr" >         
                              
                <td><small>Cant: {{intrantrans.Cantidad}}</small></td>
                <td><small> Suntotal: {{intrantrans.Subtotal}}</small></td> 
                <td><small>Proyect: {{intrantrans.ProjectID}}</small></td>               
                </tr>                
                </table>
                                     
                </div>            
                `,
                props: ['lotetras']                          
                ,
                 mounted() {                  
                },
                data() {
                    return {
                        lotetrasarr: []
                    }
                },
                methods: {
                    getlotetrans: function () {
                        axios.get("http://localhost:8000/transferencia/"+ this.lotetras+"/RI").then(response => {
                            this.lotetrasarr = response.data;    
                            console.log(this.lotetrasarr)                                      
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    cleardlotetrans: function () {
                        axios.get(`http://localhost:8000/transferencia/0/0`).then(response => {
                          this.lotetrasarr = response.data;                           
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                }
            })
            Vue.component('lotestranferencia_merma', {
                template://html
                 `
                <div>
                <div class="btn-group">                       
                <button type="button" class="btn btn-primary btn-xs" v-on:click="getlotetrans">+</button> 
                <button type="button" class="btn btn-warning btn-xs" v-on:click="cleardlotetrans">-</button>
                </div> 
                
                <table class="table" >                                              
                <tr v-for="(intrantrans,key,index) in lotetrasarr" >         
                              
                <td><small>Cant: {{intrantrans.Cantidad}}</small></td>
                <td><small> Suntotal: {{intrantrans.Subtotal}}</small></td> 
                <td><small>Proyect: {{intrantrans.ProjectID}}</small></td>               
                </tr>                
                </table>
                                     
                </div>            
                `,
                props: ['lotetras']                          
                ,
                 mounted() {                  
                },
                data() {
                    return {
                        lotetrasarr: []
                    }
                },
                methods: {
                    getlotetrans: function () {
                        axios.get("http://localhost:8000/transferencia/"+ this.lotetras+"/AJ").then(response => {
                            this.lotetrasarr = response.data;    
                            console.log(this.lotetrasarr)                                      
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    cleardlotetrans: function () {
                        axios.get(`http://localhost:8000/transferencia/0/0`).then(response => {
                          this.lotetrasarr = response.data;                           
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


