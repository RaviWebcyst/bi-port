<template >
    <div>
        <Sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">

                <div class="row">
                <div class="col-md-6">
                    <div class="card mt-4" id="amount">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Deposit  USDT.TRC20</h5>
                            <h3><img src="/b_logo.jpg" width="100" /></h3>
                        </div>
                        <div class="card-body ">
                            <label class="form-label">Enter Amount</label>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Enter Amount"
                                    v-model="form.amount1">
                            </div>
                            <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" type="button" @click="binance_pay">Submit</button>
                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="card mt-4" id="amount">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Deposit  USDT.TRC20</h5>
                                <h6>Others</h6>
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
                amount: "",
                amount1:""
            }
        }
    },
    methods: {
      binance_pay(){
              axios.post("api/payment", { amount: this.form.amount1 },{
                params:{
                  token:localStorage.getItem('usertoken')
                },
              })
                  .then(res => {
                      console.log(res);
                      this.$router.push({name:"pay_binance",params:{data:res.data.qr_code,result:res.data.data}});
                  }).catch(err => {
                      console.log(err);
                  });
          },

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
            localStorage.setItem("path","Index");
            this.$router.push({name:"Login"});
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


    }

}
</script>
<style lang="">

</style>
