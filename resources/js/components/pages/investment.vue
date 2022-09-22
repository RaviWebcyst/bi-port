<template >
    <div>
        <Sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">
            <!--<div style="position:relative;top:250px;text-align:-webkit-center;overflow:unset;z-index:100">
                <swapping-squares-spinner
                  :animation-duration="1000"
                  :size="65"
                  color="#17c1e8"
                  class="text-center"
                  :class="loading?'':'d-none'"
                  />
              </div> -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mt-4" id="amount">
                        <div class="alert alert-danger" v-if="error">{{ error }}</div>
                        <div class="alert alert-success" v-if="success">{{ success }}</div>
                            <div class="card-header d-flex bg-white">
                                <h5 class="mb-0">Activation</h5>
                                <span class="badge badge-success ms-auto">E-wallet Balance: $ {{balance}}</span>
                            </div>
                            <div class="card-body ">
                                <label class="form-label">Enter UserId</label>
                                 <span class="float-right text-success form-label"  :class="balance > 0?'d-none':'d-block'" ><a href="javascript:;" @click="addFund()"  >Add fund in USDT click here </a></span>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter UserId"
                                        v-model="form.userid" @change="users()">
                                    <div class="text-danger">{{ error }}</div>
                                    <div class="text-success">{{ name }}</div>
                                </div>
                                <label class="form-label">Choose Package</label>
                                <div class="form-group">
                                    <select class="form-control" v-model="form.amount" v-for="pack in packages">
                                        <option v-bind:value="pack.amount" >{{ pack.title }} (${{ pack.amount }})
                                        </option>
                                    </select>
                                </div>
                                <!-- <label class="form-label">Enter Amount</label>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Enter Amount"
                                    v-model="form.amount">
                            </div> -->
                                <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" :disabled="disable"
                                    @click="invest()">Activate</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row mt-5">
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
                                                    <th>Investment Id</th>
                                                    <th>Name</th>
                                                    <th>UserId</th>
                                                    <th>Amount</th>
                                                    <th>Datetime</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="investments.length > 0">
                                                <tr v-for="invest in investments">
                                                    <td>{{ invest.id }}</td>
                                                    <td>{{ invest.invests.id }}</td>
                                                    <td>{{ invest.user.name }}</td>
                                                    <td>{{ invest.user.id }}</td>
                                                    <td>${{ invest.amount }}</td>
                                                    <td>{{ new Date(invest.created_at).toLocaleString() }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
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
                userid: "",
                amount: "",
            },
            packages: [],
            error: "",
            name: "",
            disable: false,
            investments: [],
            balance:0,
            loading:true,
            success:""
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
                  localStorage.setItem("path","Index");
                  this.$router.push({name:"Login"});
              }
            this.balance = res.data.balance;
            this.form.userid = res.data.user.uid;

        }).catch(err => {
            console.log(err);
        });

        axios.get("api/packages").then(res => {
            console.log(res);
            this.packages = res.data;
            this.loading=false;


        }).catch(err => {
            console.log(err);
            this.loading=false;

        });

        axios.get("api/investments", {
            headers: {
                Authorization: `Bearer ${localStorage.usertoken}`
            },
            params:{
              token:localStorage.getItem('usertoken')
            },
        })
            .then(res => {
                console.log(res);
                this.investments = res.data;
                this.loading=false;

            }).catch(err => {
                console.log(err);
                this.loading=false;

            });


    },
    methods: {
        users() {
            axios.post("api/users", {
                spid: this.form.userid,
                token:localStorage.getItem('usertoken')
            })
                .then(res => {
                    console.log(res);
                    if (res.data.length > 0) {
                        this.name = res.data[0].name;
                        this.error = "";
                        this.disable = false;
                    }
                    else {
                        this.error = "Invalid Sponser Id";
                        this.name = "";
                        this.disable = true;
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        invest() {
            axios.post("api/invest", {
                amount: this.form.amount,
                user_id: this.form.userid,
                token:localStorage.getItem('usertoken'),
            }).then(res => {
              console.log(res);
                if (res.data.status == 200) {
                    this.success = "package activate successfully!";
                    this.error ="";
                    location.reload();

                }
                if (res.data.status == 400) {
                    this.error = "Insufficient Balance";
                    this.success = "";
                }
                if (res.data.status == 401) {
                    this.error = "Package Already Activated";
                    this.success = "";
                }

            }).catch(err => {
                console.log(err);

            })
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
