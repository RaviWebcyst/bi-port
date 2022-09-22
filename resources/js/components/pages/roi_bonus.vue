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
                            <h5 class="card-header bg-white mb-0">Daily Profit</h5>
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
                                    <!-- <div class="dataTable-container">
                                        <table class="table table-flush dataTable-table" id="datatable-search">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Date</th>
                                                    <th>Package</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> -->
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
           return this.wallets.map((d, index) => ({ ...d, sno: index + 1 }))
       }
   },

    data() {
        return {
          loading:true,
            name: "",
            email: "",
            phone: "",
            userid: "",
            spid: "",
            wallets: [],
            page: 1,
            per_page: 10,
            total: 0,
            fields: [{
                key: 'sno',
                labal: "SNO.",
            },
            {
                key: 'updated_at',
                label: 'Date',
                formatter:"formatDateAssigned"
            },
            {
                key: 'package.title',
                label: 'package'
            },
            {
                key: 'amount',
                label: 'amount'
            },
            {
                key: 'description',
                label: 'Description',

            }],

        }
    },

    created() {
        axios
            .get("api/user", {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                },
                params:{
                  token:localStorage.getItem('usertoken')
                },
            })
            .then(res => {
                  if (res.data[0] == "token_expired") {
                      localStorage.setItem("path","Index");
                      this.$router.push({name:"Login"});
                  }
                console.log(res.data.user);

                this.name = res.data.user.name;
                this.email = res.data.user.email;
                this.phone = res.data.user.phone;
                this.userid = res.data.user.uid;
                this.spid = res.data.user.spid;

            }).catch(err => {
                console.log(err);
            });

            axios.get('api/daily_profit',{
              params: {
                token:localStorage.getItem('usertoken')
              },
            }).then(res=>{
              console.log(res);
              this.wallets = res.data;
              this.loading=false;

            }).catch(err=>{
                console.log(err);
                this.loading=false;

            });
    },
    methods: {
        formatDateAssigned(value) {
          const formattedDate = new Date(value).toLocaleString();
          return formattedDate;
        }
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
