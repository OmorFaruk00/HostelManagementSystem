<template>
    <div class="container">
        <div class="table-panel table table-bordered">
            <div>
                <div class="table-panel">
                    <div class="d-flex justify-content-between table-panel-heading">
                        <div>
                            <h4 class="title">Room List</h4>
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
                                <th>Hostel</th>
                                <th>Room</th>
                                <th>Capacity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(room, index) in rooms.data" :key="index">
                                <td>{{ rooms.current_page *  rooms.per_page - rooms.per_page+ index + 1 }}</td>
                                <td>{{ room.hostel.name }}</td>
                                <td>{{ room.room }}</td>
                                <td>{{ room.capacity }}</td>
                                <td>
                                    <button class="btn" @click="DataEdit(room.id)">
                                        <img src="/images/edit.png" />
                                    </button>
                                    <button class="btn" @click="DataDelete(room.id)">
                                        <img src="/images/delete.png" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <Pagination :data="rooms" @pagination-change-page="DataGet" />
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
                            <label for=""> Hostel</label>
                            <select class="form-control" v-model="room.hostel_id">
                                <option value="" disabled selected>Select Hostel</option>
                                <option value="1" selected>Hostel 2</option>
                                <option value="2">Hostel 2</option>
                            </select>
                            <p v-if="errors.hostel_id" v-text="errors.hostel_id[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Room</label>
                            <input class="form-control" type="number" placeholder="" v-model="room.room" />
                            <p v-if="errors.room" v-text="errors.room[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Seat Capacity</label>
                            <input class="form-control" type="number" placeholder="" v-model="room.capacity" />
                            <p v-if="errors.capacity" v-text="errors.capacity[0]" class="text-danger"></p>
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
            rooms: "",
            id: "",
            toast: useToast(),
            room: {
                hostel_id: "",
                room: "",
                capacity: "",
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
                .get("/room?page=" + page)
                .then((response) => {
                    this.rooms = response.data;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        DataStore() {
            const Data = this.room;
            axios
                .post("/room", Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.room = {};
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
                .get("/room/" + id + "/edit")
                .then((res) => {
                    this.id = res.data.id;
                    this.room.room = res.data.room;
                    this.room.hostel_id = res.data.hostel_id;
                    this.room.capacity = res.data.capacity;
                    $("#customModal").modal("show");
                    this.update = true;
                    this.add = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        DataUpdate() {
            const Data = this.room;
            axios
                .put("/room/" + this.id, Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.errors = "";
                    this.update = false;
                    this.add = true;
                    this.room = {};
                    this.room.type = "Boys";
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
                    axios.delete("/room/" + id)
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
            this.room = {};
            this.room.type = "Boys"
        },
    },
};
</script>
