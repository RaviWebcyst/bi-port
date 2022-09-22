<template >
    <div>
        <Sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mt-4" id="amount">
                            <div class="alert alert-danger" v-if="error != ''">{{ error }}</div>
                            <div class="alert alert-success" v-if="success != ''">{{ success }}</div>
                            <div class="card-header bg-white pt-3 pb-3">
                            <span class="badge badge-success ms-auto float-right">E-wallet Balance: $ {{balance}}</span>
                                <h5 class="mb-0">Investment</h5>
                                <small class="text-warning">Amount Between 100 to 100000</small>
                            </div>
                            <div class="card-body ">
                                <form>
                                    <div class="form-group">
                                        <label class="form-label">Amount</label>
                                         <span class="float-right text-success form-label"  :class="balance > 0?'d-none':'d-block'" ><a href="javascript:;" @click="addFund()"  >Add fund in USDT click here </a></span>
                                        <input type="text" class="form-control" v-model="form.amount"
                                            placeholder="Enter Amount">
                                    </div>
                                    <!-- <label class="form-label">Enter Amount</label>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Enter Amount"
                                    v-model="form.amount">
                            </div> -->
                                    <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" type="button"
                                        @click="invest()">Submit</button>
                                </form>
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
    data() {
        return {
            form: {
                amount: ""
            },
            error: "",
            success: "",
            balance:0,
            enable:0

        }
    },
    created() {
    axios
        .get("api/user", {
            params:{
              token:localStorage.getItem('usertoken')
            },
        })
        .then(res => {
            if (res.data[0] == "token_expired") {
                this.$router.push({name:"Login"});
            }
            this.balance = res.data.balance;
            this.enable = res.data.user.enable;

        }).catch(err => {
            console.log(err);
        });

    },
    methods: {
        invest() {
          if(this.enable == 1){
            axios.post("api/topup", {
                amount: this.form.amount,
                token:localStorage.getItem('usertoken')

            },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.usertoken}`
                    },


                }).then(res => {
                    console.log(res);
                    if (res.data.status == 200) {
                        this.error = "";
                        this.amount = "";
                        this.success = "package activate successfully!";
                        location.reload();
                    }
                    if (res.data.status == 401) {
                        this.success = "";
                        this.error = "Insufficient Balance";
                    }
                    if (res.data.status == 402) {
                        this.success = "";
                        this.error = "Invalid Amount";
                    }
                    if (res.data.status == 403) {
                        this.success = "";
                        this.error = "Less Amount than previous Investment";
                    }

                }).catch(err => {
                    console.log(err);

                });
                }
                else{
                  this.error = "Please Activate Your Package First";
                  this.success="";
                }
        },
        addFund(){
          localStorage.setItem("path","Recharge");
          this.$router.push({name:"Recharge"});
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
<style >
.badge-success {
    color: #67b108 !important;
    background-color: #cdf59b !important;
}
</style>
