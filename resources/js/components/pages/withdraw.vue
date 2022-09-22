<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div class="contianer-fluid px-4 py-4">

                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <div class="card mt-4" id="password">
                            <div class="alert alert-danger" v-if="error!=''">{{error}}</div>
                            <div class="alert alert-success" v-if="success!=''">{{success}}</div>
                            <div class="card-header bg-white pt-3 pb-3">
                                <h5 class="mb-0">Withdraw</h5>
                                <small class="text-warning">Minimum Withdraw Amount is $2</small>
                            </div>
                            <div class="card-body ">
                                <label class="form-label">Amount</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Amount to Withdraw"
                                        v-model="form.amount">
                                </div>
                                <label class="form-label">Password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Enter Your Password"
                                        v-model="form.password">
                                </div>
                                <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" type="button" @click="withdraw">Withdraw</button>
                                <!-- <button class="btn bg-gradient-light btn-sm float-end mt-2 mb-0">Cancel</button> -->
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
export default {
    components: {
        Header,
        Sidebar,
    },

    data() {
        return {
            form: {
                amount: "",
                password: "",
            },
            error:"",
            success:""
        }
    },
    methods: {
        withdraw() {
            axios.post("api/withdraw", {
                amount: this.form.amount,
                password: this.form.password,
                token:localStorage.getItem('usertoken')
            },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.usertoken}`
                    },
                }).then(res=>{
                    console.log(res);
                    if(res.data.status == 400){
                        this.error = "Invalid Password";
                        this.success ="";
                    }
                    if(res.data.status == 401){
                        this.error = "Insufficient Balance or Minimum Amount";
                        this.success ="";
                    }
                    if(res.data.status == 200){
                        this.error = "";
                        this.form.amount = "";
                        this.form.password = "";
                        this.success ="Amount Withdrawal successfully";
                    }
                }).catch(err=>{
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
    created(){
    axios
        .get("api/user", {
            headers: {
                Authorization: `Bearer ${localStorage.usertoken}`,
            },
            params:{
              token:localStorage.getItem('usertoken')
            },
        })
        .then((res) => {
            if (res.data[0] == "token_expired") {
                localStorage.setItem("path","Index");
                this.$router.push({name:"Index"});
            }

        })
        .catch((err) => {
          console.log("error");
            console.log(err);
        });
    }





}
</script>
<style lang="">

</style>
