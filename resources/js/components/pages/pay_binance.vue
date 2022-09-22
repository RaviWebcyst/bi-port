<template >
    <div>
        <sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <Header />
            <div style="position:relative;top:250px;text-align:-webkit-center;overflow:unset;z-index:100">
                <swapping-squares-spinner
                  :animation-duration="1000"
                  :size="65"
                  color="#17c1e8"
                  class="text-center"
                  :class="loading?'':'d-none'"
                  />
              </div>
            <div class="card mt-5">
                <div class="card-body">
                    <div class="text-center">
                        <img :src="qr_code" alt="">

                        <div class="mt-3">
                            Address : <span>{{address}}</span>
                        </div>
                        <div class="mt-1">
                            Txn Id : <span>{{txn_id}}</span>
                        </div>
                        <div class="mt-1">
                            Amount : <span>{{amount}}</span>
                        </div>
                        <div class="mt-2">
                            Total Amount : <span>{{Number(amount)+Number(0.8)}}(0.8 fees)</span>


                        </div>


                        <div class="pt-5 text-danger">
                        Please Pay with exact  amount otherwise amount will be refunded
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

    data(){
        return {
            qr_code:this.$route.params.data,
            txn_id:this.$route.params.result.txn_id,
            address:this.$route.params.result.address,
            amount:this.$route.params.result.amount,
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
            this.loading=false;


        }).catch(err => {
            console.log(err);
            this.loading=false;

        });
    }

}
</script>
