<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">
            <div style="position:relative;top:250px;text-align:-webkit-center;overflow:unset;z-index:100">
                <swapping-squares-spinner
                  :animation-duration="1000"
                  :size="65"
                  color="#17c1e8"
                  class="text-center"
                  :class="loading?'':'d-none'"
                  />
              </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="card-header bg-white mb-0">Team Level List </h5>
                            <div class="table-responsive">
                                <div
                                    class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                                    <div class="container-fluid">
                                       <div class="overflow-auto">
                                           <b-table id="my-table" :items="itemsWithSno" :per-page="per_page"
                                               :current-page="page" :fields="fields" small></b-table>
                                               <b-pagination v-model="page" :total-rows="total" :per-page="per_page"
                                               aria-controls="my-table" v-if="total>0"></b-pagination>

                                       </div>
                                   </div>


                                    <!-- <div class="dataTable-top">
                                <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..."
                                        type="text"></div>
                            </div> -->
                                  <!--  <div class="dataTable-container">
                                        <table class="table table-flush dataTable-table" id="datatable-search">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Level</th>
                                                    <th>Inactive Id's</th>
                                                    <th>Active Id's</th>
                                                    s
                                                </tr>
                                            </thead>
                                            <tbody v-if="levels.length > 0">
                                                <tr v-for="level in levels">
                                                    <td>{{level.level}}</td>
                                                    <td>{{level.inactive}}</td>
                                                    <td>{{level.active}}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>-->
                                    <!-- <div class="dataTable-bottom">
                                    <div class="dataTable-info">Showing 1 to 10 of 12 entries</div>
                                    <nav class="dataTable-pagination">
                                        <ul class="dataTable-pagination-list">
                                            <li class="pager"><a href="#" data-page="1">‹</a></li>
                                            <li class="active"><a href="#" data-page="1">1</a></li>
                                            <li class=""><a href="#" data-page="2">2</a></li>
                                            <li class="pager"><a href="#" data-page="2">›</a></li>
                                        </ul>
                                    </nav>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>

import Header from "./header.vue";
import Sidebar from "./sidebar.vue";
import { SwappingSquaresSpinner  } from 'epic-spinners';
export default {
    components: {
        Header,
        Sidebar,
        'swapping-squares-spinner':SwappingSquaresSpinner,
    },
    computed: {
        itemsWithSno() {
            return this.levels.map((d, index) => ({ ...d, sno: index + 1 }))
        }
    },

    data() {
        return {
           levels:[],
           loading:true,
           page: 1,
          per_page: 10,
          total: 0,
          fields: [{
              key: 'sno',
              labal: "#",
          },
          {
              key: 'level',
              label: 'Level'
          },

          {
              key: 'inactive',
              label: "Inactive Id's"
          },
          {
              key: 'active',
              label: "Active Id's"
          }],
        }
    },

    created() {
            axios.get("api/user", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                },
                params:{
                  token:localStorage.getItem('usertoken')
                },
            })
                .then(res => {
                    console.log(res);
                    if (res.data[0] == "token_expired") {
                        localStorage.setItem("path","Index");
                        this.$router.push({name:"Login"});
                    }
                    this.email = res.data.user.email;
                    this.password = res.data.user.showPass;

                }).catch(err => {
                    console.log(err.response);
                });

            axios.get("api/levelList",{
                 headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                },
                params:{
                  token:localStorage.getItem('usertoken')
                },
            }).then(res=>{
                console.log(res);
                this.levels = res.data;
                this.total = res.data.length;
                this.loading=false;

            }).catch(err=>{
                console.log(err);
                this.loading=false;

            });
    },
    mounted() {
        if(localStorage.getItem('usertoken') == null){
            localStorage.setItem("path","Index");
            this.$router.push({name:"Login"});
        }
    }


}
</script>
<style lang="">

</style>
