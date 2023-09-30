import { defineStore } from "pinia";
import { useToast } from "vue-toast-notification";
import Swal from "sweetalert2";
import axios from "@/axios";

export const rentStore = defineStore("rent", {
    state: () => ({
        add: true,
        update: false,
        errors: "",
        rents: "",
        id: "",
        toast: useToast(),
        rent: {
            hostel_id: "",
            rent_id: "",
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
            this.errors = "";
            this.add = true;
            this.rent.hostel_id = "";
            this.rent.bed_type = "";
            this.rent.monthly_fee = "";
            this.rent.start_date = "";
            this.rent.end_date_date = "";
            
        },
        DataGet(page = 1) {
            axios
                .get("/rent?page=" + page)
                .then((response) => {
                    this.rents = response.data;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },     
        DataStore() {
            const Data = this.rent;
            axios
                .post("/rent", Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.rent.hostel_id = res.data.hostel_id;
                    this.rent.bed_type = res.data.bed_type;
                    this.rent.monthly_fee = res.data.monthly_fee;
                    this.rent.start_date = res.data.start_date;
                    this.rent.end_date = res.data.end_date;
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
                .get("/rent/" + id + "/edit")
                .then((res) => {
                    this.id = res.data.id;
                    this.rent.hostel_id = res.data.hostel_id;
                    this.rent.bed_type = res.data.bed_type;
                    this.rent.monthly_fee = res.data.monthly_fee;
                    this.rent.start_date = res.data.start_date;
                    this.rent.end_date = res.data.end_date;
                    $("#customModal").modal("show");
                    this.update = true;
                    this.add = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        DataUpdate() {
            const Data = this.rent;
            axios
                .put("/rent/" + this.id, Data)
                .then((res) => {
                    $("#customModal").modal("hide");
                    this.toast.success(res.data.message, {
                        position: "top-right",
                    });
                    this.update = false;
                    this.add = true;
                    this.rent.hostel_id = "";
                    this.rent.bed_type = "";
                    this.rent.monthly_fee = "";
                    this.rent.start_date = "";
                    this.rent.end_date_date = "";
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
                        .delete("/rent/" + id)
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
