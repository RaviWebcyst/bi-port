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
                            <h5 class="card-header mb-0 bg-white">User Profile</h5>
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
                                                    <th><a href="#" class="dataTable-sorter">Referal UserId</a></th>
                                                    <th><a href="#" class="dataTable-sorter">UserId</a></th>
                                                    <th><a href="#" class="dataTable-sorter">Email Id</a></th>
                                                    <th><a href="#" class="dataTable-sorter">Name</a></th>
                                                    <th><a href="#" class="dataTable-sorter">Mobile</a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!-- <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="customCheck1">
                                                        </div> -->
                                                            <p class="text-xs font-weight-bold ms-2 mb-0">{{ spid }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-bold">
                                                        <span class="my-2 text-xs">{{ userid }}</span>
                                                    </td>
                                                    <td class="text-xs font-weight-bold">
                                                        <div class="d-flex align-items-center">
                                                            <!-- <button
                                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                                class="fas fa-check" aria-hidden="true"></i></button> -->
                                                            <span>{{ email }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-xs font-weight-bold">
                                                        <div class="d-flex align-items-center">
                                                            <!-- <img src="assets/img/team-2.jpg" class="avatar avatar-xs me-2"
                                                            alt="user image"> -->
                                                            <span>{{ name }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-xs font-weight-bold">
                                                        <span class="my-2 text-xs">{{ phone }}</span>
                                                    </td>
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
            name: "",
            email: "",
            phone: "",
            userid: "",
            spid: "",
            loading:true
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
                this.loading=false;


            }).catch(err => {
                console.log(err);
                this.loading=false;

            });
    },
    mounted(){
        if(localStorage.getItem('usertoken') == null){
              localStorage.setItem("path","Index");
              this.$router.push({name:"Login"});
        }
    }

}
</script>
<style lang="">

</style>
