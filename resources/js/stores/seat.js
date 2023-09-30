import { defineStore } from "pinia";
import { useToast } from "vue-toast-notification";
import Swal from "sweetalert2";
import axios from "@/axios";

export const seatStore = defineStore("seat", {
    state: () => ({
        add: true,
        update: false,
        errors: "",
        seats: "",
        id: "",
        toast: useToast(),
        seat: {
            hostel_id: "",
            room_id: "",
            bed_type: "",
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
            this.seat.hostel_id = "";
            this.seat.seat = "";
            this.seat.capacity = "";
            this.errors = "";
        },
        DataGet(page = 1) {
            axios
                .get("/seat?page=" + page)
                .then((response) => {
                    this.seats = response.data;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        DataStore() {
            const Data = this.seat;
            axios
                .post("/seat", Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.seat.hostel_id = "";
                    this.seat.seat = "";
                    this.seat.capacity = "";
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
                .get("/seat/" + id + "/edit")
                .then((res) => {
                    this.id = res.data.id;
                    this.seat.seat = res.data.seat;
                    this.seat.hostel_id = res.data.hostel_id;
                    this.seat.capacity = res.data.capacity;
                    $("#customModal").modal("show");
                    this.update = true;
                    this.add = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        DataUpdate() {
            const Data = this.seat;
            axios
                .put("/seat/" + this.id, Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.update = false;
                    this.add = true;
                    this.seat.hostel_id = "";
                    this.seat.seat = "";
                    this.seat.capacity = "";
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
                        .delete("/seat/" + id)
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
