import { defineStore } from "pinia";
import { useToast } from "vue-toast-notification";
import Swal from "sweetalert2";
import axios from "@/axios";

export const roomStore = defineStore("room", {
    state: () => ({
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
    }),
    getters: {},
    actions: {
        CreateModal() {
            $("#customModal").modal("show");
        },
        RemoveBtn() {
            this.add = true;
            this.update = false;
            this.room.hostel_id = "";
            this.room.room = "";
            this.room.capacity = "";
            this.errors = "";
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
                    this.room.hostel_id = "";
                    this.room.room = "";
                    this.room.capacity = "";
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
                    this.update = false;
                    this.add = true;
                    this.room.hostel_id = "";
                    this.room.room = "";
                    this.room.capacity = "";
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
        DataDelete(id) {
            Swal.fire({
                title: "Confirm Delete",
                text: "Are you sure you want to delete this item?",
                type: "warning",
                icon: "warning",
                position: "top",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete it!",
            }).then((result) => {
                if (result.value) {
                    axios
                        .delete("/room/" + id)
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
    },
});
