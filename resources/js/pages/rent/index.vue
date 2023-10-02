<template>
    <div class="container">
        <div class="table-panel table table-bordered">
            <div>
                <div class="table-panel">
                    <div class="d-flex justify-content-between table-panel-heading">
                        <div>
                            <h4 class="title">rent List</h4>
                        </div>
                        <div>
                            <div class="">
                                <button type="button" class="btn-submit" @click="store.CreateModal()">
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
                                <th>Bed Type</th>
                                <th>Monthly Fee</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(rent, index) in store.rents.data" :key="index">
                                <td>{{ store.rents.current_page * store.rents.per_page - store.rents.per_page + index + 1 }}
                                </td>
                                <td>{{ rent.hostel.name }}</td>
                                <td>{{ rent.bed_type }}</td>
                                <td>{{ rent.monthly_fee }}</td>
                                <td>{{ rent.start_date }}</td>
                                <td v-if="rent.end_date==null">Till Now</td>
                                <td v-else>{{ rent.end_date }}</td>
                                <td>
                                    <button class="btn" @click="store.DataEdit(rent.id)">
                                        <img src="/images/edit.png" />
                                    </button>
                                    <button class="btn" @click="store.DataDelete(rent.id)">
                                        <img src="/images/delete.png" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>                  
                    <div class="d-flex justify-content-end">
                        <Bootstrap5Pagination :data="store.rents" @pagination-change-page="store.DataGet" />
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
                        <h5 v-if="store.add" class="modal-title" id="customModalLabel">
                            Create
                        </h5>
                        <h5 v-if="store.update" class="modal-title" id="customModalLabel">
                            Update
                        </h5>
                        <button @click="store.RemoveBtn()" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for=""> Hostel</label>
                            <select class="form-control" v-model="store.rent.hostel_id">
                                <option value="" disabled selected>Select Hostel</option>
                                <option v-for="(hostel, index) in hostelstore.allhostels" :key="index" :value="hostel.id" selected>{{ hostel.name }}</option>
                                
                            </select>
                            <span v-if="store.errors.hostel_id" v-text="store.errors.hostel_id[0]" class="text-danger"></span>
                        </div>
                      
                        <div class="form-group">
                            <label for=""> Bed Type</label>
                            <select class="form-control" v-model="store.rent.bed_type">
                                <option value="" disabled selected>Select Bed Type</option>
                                <option value="Room">Room</option>
                                <option value="Relax">Relax</option>
                                <option value="Deluxe">Deluxe</option>
                                <option value="SuperDeluxe">Super Deluxe</option>
                                <option value="Dorm">Dorm</option>                           
                                
                            </select>
                            <span v-if="store.errors.bed_type" v-text="store.errors.bed_type[0]" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for=""> Monthly Fee</label>
                            <input class="form-control" type="number" placeholder="" v-model="store.rent.monthly_fee" />
                            <p v-if="store.errors.monthly_fee" v-text="store.errors.monthly_fee[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input class="form-control" type="date" placeholder="" v-model="store.rent.start_date" />
                            <p v-if="store.errors.start_date" v-text="store.errors.start_date[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input class="form-control" type="date" placeholder="" v-model="store.rent.end_date" />
                            <p v-if="store.errors.end_date" v-text="store.errors.end_date[0]" class="text-danger"></p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button v-if="store.add" type="button" class="btn btn-submit" @click="store.DataStore()">
                            Submit
                        </button>
                        <button v-if="store.update" type="button" class="btn btn-submit" @click="store.DataUpdate()">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { rentStore } from '@/stores/rent.js';
import { hostelStore } from '@/stores/hostel.js';
import { onMounted } from 'vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
const store = rentStore();
const hostelstore = hostelStore();
onMounted(() => {
    store.DataGet();
    hostelstore.getHostel();

})
</script>



