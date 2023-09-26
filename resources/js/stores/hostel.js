import { defineStore } from "pinia";
import { useToast } from "vue-toast-notification";
import Swal from "sweetalert2";
import axios from "@/axios";

export const hostelStore = defineStore("hostel", {
    state: () => ({
        allhostels: "",
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
    }),
    actions: {
        CreateModal() {
            $("#customModal").modal("show");
        },
        getHostel() {
            axios
                .get("/hostel/0")
                .then((response) => {
                    this.allhostels = response.data;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
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
                    this.hostel.name = "";
                    this.hostel.address = "";
                    this.hostel.type = "Boys";
                    this.hostel.description = "";
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
                    this.hostel.name = "";
                    this.hostel.address = "";
                    this.hostel.type = "Boys";
                    this.hostel.description = "";
                    this.errors = "";
                    this.DataGet();
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
                        .delete("/hostel/" + id)
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
            this.hostel.name = "";
            this.hostel.address = "";
            this.hostel.type = "Boys";
            this.hostel.description = "";
            this.errors = "";
        },
    },
});
