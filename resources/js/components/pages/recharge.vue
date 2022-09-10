<template >
    <div>
        <Sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mt-4" id="amount">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Deposit With USDT</h5>
                            </div>
                            <div class="card-body ">
                                <label class="form-label">Enter Amount</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Amount"
                                        v-model="form.amount">
                                </div>
                                <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" type="button" @click="pay">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

              <!--  <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <div
                                    class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                    <div class="dataTable-container">
                                        <table class="table table-flush dataTable-table" id="datatable-search">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </main>
    </div>
</template>
<script>
import Header from "./header.vue";
import Sidebar from "./sidebar.vue";
export default {
    components: {
        Header,
        Sidebar,
    },
    data() {
        return {
            form: {
                amount: ""
            }
        }
    },
    methods: {
        pay() {
            axios.post("api/payment", { amount: this.form.amount },{
              params:{
                token:localStorage.getItem('usertoken')
              },
            })
                .then(res => {
                    console.log(res);
                    this.$router.push({name:"pay",params:{data:res.data.qr_code,result:res.data.data}});
                }).catch(err => {
                    console.log(err);
                })
        }
    },
    mounted() {
        if(localStorage.getItem('usertoken') == null){
            localStorage.setItem("path","Login");
            this.$router.push({name:"Login"});
        }
    }

}
</script>
<style lang="">

</style>
