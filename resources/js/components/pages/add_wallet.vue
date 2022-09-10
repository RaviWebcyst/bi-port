<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />

            <div class="contianer-fluid px-4 py-4">

                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <div class="card mt-4" id="password">
                        <div class="text-danger">{{ error }}</div>
                        <div class="text-success">{{ success }}</div>
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Fund Transfer from Main Wallet to E-wallet</h5>
                            </div>
                            <div class="card-body ">
                                <label class="form-label">Amount</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Amount"
                                        v-model="form.amount">
                                </div>

                                <label class="form-label">Password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Enter Your Password"
                                        v-model="form.password">
                                </div>
                                <button class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0" type="button" @click="transfer">Submit</button>
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
            success:"",
            error:""

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

        })
        .catch((err) => {
          console.log("error");
            console.log(err);
        });
    },


    methods:{


         transfer() {
            axios.post("api/wallet_transfer", {
                user_id: this.form.userId,
                password: this.form.password,
                amount: this.form.amount
            }, {
                headers: {
                    Authorization: `Bearer ${localStorage.usertoken}`
                },
                params:{
                  token:localStorage.getItem('usertoken')
                },

            }).then(res => {
                console.log(res);
                if (res.data.status == 401) {
                    this.error = "Invalid Password";
                    this.success = "";
                }
                if (res.data.status == 400) {
                    this.error = "Insufficent Balance";
                    this.success = "";
                }
                if (res.data.status == 200) {
                    this.error = "";
                    this.form.userId = "";
                    this.form.password = "";
                    this.form.amount = "";
                    this.success = "Fund Transfer successfully";
                }
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
