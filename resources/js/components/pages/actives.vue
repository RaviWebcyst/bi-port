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
                            <h5 class="card-header bg-white mb-0">Active Packages</h5>
                            <div class="table-responsive">
                                <div
                                    class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                    <!-- <div class="dataTable-top">
                                <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..."
                                        type="text"></div>
                            </div> -->
                                    <div class="dataTable-container">
                                        <table class="table table-flush dataTable-table" id="datatable-search">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Package Name</th>
                                                    <th>Amount</th>
                                                    <th>Activate Date</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="actives.length > 0">
                                                <tr v-for="active in actives">
                                                    <td>{{ active.id }}</td>
                                                    <td>{{ active.title }}</td>
                                                    <td>${{ active.amount }}</td>
                                                    <td>{{ new Date(active.updated_at).toLocaleString() }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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

    data() {
        return {
            actives: [],
            loading:true,
        }
    },

    created() {
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
                this.$router.push({name:"Login"});
            }
        })
        .catch((err) => {
          console.log("error");
            console.log(err);
        });

        axios.get("api/activePackages", {
            headers: {
                Authorization: `Bearer ${localStorage.usertoken}`
            },
            params:{
              token:localStorage.getItem('usertoken')
            },
        })
            .then(res => {
                console.log(res);
                this.actives = res.data;
                this.loading=false;

            }).catch(err => {
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
