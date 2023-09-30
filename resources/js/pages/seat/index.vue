<template>
    <div class="container">
        <div class="table-panel table table-bordered">
            <div>
                <div class="table-panel">
                    <div class="d-flex justify-content-between table-panel-heading">
                        <div>
                            <h4 class="title">seat List</h4>
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
                                <th>Room Number</th>
                                <th>Bed Type</th>
                                <th>Available</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(seat, index) in store.seats.data" :key="index">
                                <td>{{ store.seats.current_page * store.seats.per_page - store.seats.per_page + index + 1 }}
                                </td>
                                <td>{{ seat.hostel.name }}</td>
                                <td>{{ seat.room.room }}</td>
                                <td>{{ seat.bed_type }}</td>
                                <td>{{ seat.available }}</td>
                                <td>
                                    <button class="btn" @click="store.DataEdit(seat.id)">
                                        <img src="/images/edit.png" />
                                    </button>
                                    <button class="btn" @click="store.DataDelete(seat.id)">
                                        <img src="/images/delete.png" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>                  
                    <div class="d-flex justify-content-end">
                        <Bootstrap5Pagination :data="store.seats" @pagination-change-page="store.DataGet" />
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
                            <select class="form-control" v-model="store.seat.hostel_id" @change="roomstore.getRooms(store.seat.hostel_id)">
                                <option value="" disabled selected>Select Hostel</option>
                                <option v-for="(hostel, index) in hostelstore.allhostels" :key="index" :value="hostel.id" selected>{{ hostel.name }}</option>
                                
                            </select>
                            <p v-if="store.errors.hostel_id" v-text="store.errors.hostel_id[0]" class="text-danger"></p>
                        </div>

                        <div class="form-group">
                            <label for=""> Room</label>
                            <select class="form-control" v-model="store.seat.room_id" >
                                <option value="" disabled selected>Select Room</option>
                                <option v-for="(room, index) in roomstore.getrooms " :key="index" :value="room.id" selected>{{ room.room }}</option>
                                
                            </select>
                            <p v-if="store.errors.room" v-text="store.errors.room[0]" class="text-danger"></p>
                        </div>

                        <div class="form-group">
                            <label for="">Bed Type</label>
                            <input class="form-control" type="text" placeholder="" v-model="store.seat.bed_type" />
                            <p v-if="store.errors.bed_type" v-text="store.errors.bed_type[0]" class="text-danger"></p>
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
        {{ roomstore.getrooms }}
    </div>
</template>
<script setup>
import { seatStore } from '@/stores/seat.js';
import { hostelStore } from '@/stores/hostel.js';
import { roomStore } from '@/stores/room.js';
import { onMounted } from 'vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
const store = seatStore();
const roomstore = roomStore();
const hostelstore = hostelStore();
onMounted(() => {
    store.DataGet();
    hostelstore.getHostel();

})
</script>

