<template>
    <div class="container">
        <div class="table-panel table table-bordered">
            <div>
                <div class="table-panel">
                    <div class="d-flex justify-content-between table-panel-heading">
                        <div>
                            <h4 class="title">Hostel List</h4>
                        </div>
                        <div>
                            <div class="">
                                <button type="button" class="btn-submit" @click="CreateModal()">
                                    create
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Hostel Name</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(hostel, index) in hostels.data" :key="index">
                                <td>{{ hostels.current_page *  hostels.per_page - hostels.per_page+ index + 1 }}</td>
                                <td>{{ hostel.name }}</td>
                                <td>{{ hostel.type }}</td>
                                <td>{{ hostel.address }}</td>
                                <td>
                                    <button class="btn" @click="DataEdit(hostel.id)">
                                        <img src="/images/edit.png" />
                                    </button>
                                    <button class="btn" @click="DataDelete(hostel.id)">
                                        <img src="/images/delete.png" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <Pagination :data="hostels" @pagination-change-page="DataGet" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="customModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="add" class="modal-title" id="customModalLabel">
                            Create
                        </h5>
                        <h5 v-if="update" class="modal-title" id="customModalLabel">
                            Update
                        </h5>
                        <button @click="RemoveBtn()" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""> Name</label>
                            <input class="form-control" type="text" placeholder="" v-model="hostel.name" />
                            <p v-if="errors.name" v-text="errors.name[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Type</label>
                            <select class="form-control" v-model="hostel.type">
                                <option value="Boys" selected>Boys</option>
                                <option value="Girls">Girls</option>
                            </select>
                            <p v-if="errors.type" v-text="errors.type[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Address</label>
                            <input class="form-control" type="text" placeholder="" v-model="hostel.address" />
                            <p v-if="errors.address" v-text="errors.address[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Short Description</label>
                            <textarea class="form-control" rows="3" v-model="hostel.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-if="add" type="button" class="btn btn-submit" @click="DataStore()">
                            Submit
                        </button>
                        <button v-if="update" type="button" class="btn btn-submit" @click="DataUpdate()">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>


<script>
import axios from "@/axios";
import { useToast } from "vue-toast-notification";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
export default {
    components: {
        'Pagination': Bootstrap5Pagination,
    },
    data() {
        return {
            add: true,
            update: false,
            errors: "",
            hostels: "",
            id: "",
            toast: useToast(),
            hostel: {
                name: "",
                address: "",
                type: "Boys",
                description: "",
            },
        };
    },
    created() {
        this.DataGet();
    },

    methods: {
        CreateModal() {
            $("#customModal").modal("show");
        },
        DataGet(page = 1) {
            axios
                .get("/hostel?page=" + page)
                .then((response) => {
                    this.hostels = response.data;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        DataStore() {
            const Data = this.hostel;
            axios
                .post("/hostel", Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.hostel = {};
                    this.errors = "";
                    this.DataGet();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.toast.warning("Something Went Wrong!", {
                        position: "top-right",
                    });
                });
        },
        DataEdit(id) {
            axios
                .get("/hostel/" + id + "/edit")
                .then((res) => {
                    this.id = res.data.id;
                    this.hostel.name = res.data.name;
                    this.hostel.type = res.data.type;
                    this.hostel.address = res.data.address;
                    this.hostel.description = res.data.description;
                    $("#customModal").modal("show");
                    this.update = true;
                    this.add = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        DataUpdate() {
            const Data = this.hostel;
            axios
                .put("/hostel/" + this.id, Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.errors = "";
                    this.update = false;
                    this.add = true;
                    this.hostel = {};
                    this.hostel.type = "Boys";
                    this.DataGet();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.toast.warning("Something Went Wrong!", {
                        position: "top-right",
                    });
                });
        },


        DataDelete(id) {
            this.$swal({
                title: 'Confirm Delete',
                text: 'Are you sure you want to delete this item?',
                type: "warning",
                icon: 'warning',
                position: "top",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: "Yes, Delete it!"
            }).then((result) => {
                if (result.value) {
                    axios.delete("/hostel/" + id)
                        .then((res) => {
                            this.toast.success(res.data.message, {
                                position: "top-right",
                            });
                            this.DataGet();

                        })
                        .catch((error) => {
                            this.toast.warning("Something Went Wrong!", {
                                position: "top-right",
                            });
                        });

                }
            });
        },

        RemoveBtn() {
            this.add = true;
            this.update = false;
            this.hostel = {};
            this.hostel.type = "Boys"
        },
    },
};
</script>
