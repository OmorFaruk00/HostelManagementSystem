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
                                <th>Room</th>
                                <th>Capacity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(room, index) in store.rooms.data" :key="index">
                                <td>{{ store.rooms.current_page * store.rooms.per_page - store.rooms.per_page + index + 1 }}
                                </td>
                                <td>{{ room.hostel.name }}</td>
                                <td>{{ room.room }}</td>
                                <td>{{ room.capacity }}</td>
                                <td>
                                    <button class="btn" @click="store.DataEdit(room.id)">
                                        <img src="/images/edit.png" />
                                    </button>
                                    <button class="btn" @click="store.DataDelete(room.id)">
                                        <img src="/images/delete.png" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>                  
                    <div class="d-flex justify-content-end">
                        <Bootstrap5Pagination :data="store.rooms" @pagination-change-page="store.DataGet" />
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
                            <select class="form-control" v-model="store.room.hostel_id">
                                <option value="" disabled selected>Select Hostel</option>
                                <option v-for="(hostel, index) in hostelstore.allhostels" :key="index" :value="hostel.id" selected>{{ hostel.name }}</option>
                                
                            </select>
                            <p v-if="store.errors.hostel_id" v-text="store.errors.hostel_id[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for=""> Room</label>
                            <input class="form-control" type="number" placeholder="" v-model="store.room.room" />
                            <p v-if="store.errors.room" v-text="store.errors.room[0]" class="text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Seat Capacity</label>
                            <input class="form-control" type="number" placeholder="" v-model="store.room.capacity" />
                            <p v-if="store.errors.capacity" v-text="store.errors.capacity[0]" class="text-danger"></p>
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
import { roomStore } from '@/stores/room.js';
import { hostelStore } from '@/stores/hostel.js';
import { onMounted } from 'vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
const store = roomStore();
const hostelstore = hostelStore();
onMounted(() => {
    store.DataGet();
    hostelstore.getHostel();

})
</script>



