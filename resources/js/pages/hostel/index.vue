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
                                <th>Hostel Name</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(hostel, index) in store.hostels.data" :key="index">
                                <td>{{ store.hostels.current_page * store.hostels.per_page - store.hostels.per_page + index +
                                    1 }}</td>
                                <td>{{ hostel.name }}</td>
                                <td>{{ hostel.type }}</td>
                                <td>{{ hostel.address }}</td>
                                <td>
                                    <button class="btn" @click="store.DataEdit(hostel.id)">
                                        <img src="/images/edit.png" />
                                    </button>
                                    <button class="btn" @click="store.DataDelete(hostel.id)">
                                        <img src="/images/delete.png" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  
                    <div class="d-flex justify-content-end">
                        <Bootstrap5Pagination :data="store.hostels" @pagination-change-page="store.DataGet" />
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
                            <label for=""> Name</label>
                            <input class="form-control" type="text" placeholder="" v-model="store.hostel.name" />
                            <p v-if="store.errors.name" v-text="store.errors.name[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Type</label>
                            <select class="form-control" v-model="store.hostel.type">
                                <option value="Boys" selected>Boys</option>
                                <option value="Girls">Girls</option>
                            </select>
                            <p v-if="store.errors.type" v-text="store.errors.type[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Address</label>
                            <input class="form-control" type="text" placeholder="" v-model="store.hostel.address" />
                            <p v-if="store.errors.address" v-text="store.errors.address[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Short Description</label>
                            <textarea class="form-control" rows="3" v-model="store.hostel.description"></textarea>
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
import { hostelStore } from '@/stores/hostel.js';
import { onMounted } from 'vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
const store = hostelStore();
onMounted(() => {
    store.DataGet();

})
</script>
