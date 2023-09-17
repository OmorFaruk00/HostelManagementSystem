<template>
    <div class="container">
        <div class="table-panel table table-bordered">
            <div>
            <div class="table-panel">
                <div class="d-flex justify-content-between table-panel-heading">
                    <div>
                        <h4 class="title">Data List</h4>
                    </div>
                    <div>
                        <div class="">
                            <button
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#customModal"
                                class="btn btn-submit"
                            >
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
                            <th>#</th>
                            <th>First</th>
                            <th>Last</th>
                            <th>Handle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <button class="btn" @click="DataEdit()">
                                    <img src="/images/edit.png" />
                                </button>
                                <button class="btn">
                                    <img src="/images/delete.png" />
                                  
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="customModal"
            tabindex="-1"
            aria-labelledby="customModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="add" class="modal-title" id="customModalLabel">
                            Create
                        </h5>
                        <h5 v-if="update" class="modal-title" id="customModalLabel">
                            Update
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""> Name</label>
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                v-model="name"
                            />
                        </div>
                        <div class="form-group">
                            <label for=""> Email</label>
                            <input
                                class="form-control"
                                type="text"
                                placeholder=""
                                v-model="name"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-if="add" type="button" class="btn btn-submit">
                            Submit
                        </button>
                        <button v-if="update" type="button" class="btn btn-submit">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
   data(){
    return {
            add: true,
            update: false,           
            errors: {},
           
        };
    },
    methods: {
        DataEdit(){
            this.update = true;
            this.add = false;
            $("#customModal").modal("show");
        }
    }

};
</script>
<!-- 
<style scoped>
.demo {
    font-family: "Noto Sans", sans-serif;
}
.w-12 {
    width: 125px;
}
.w-4 {
    width: 40px;
}

.table-panel {
    border-radius: 0;
    border: none;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    margin-top: 30px;
}
.table-panel .table-panel-heading {
    background: linear-gradient(#f5f5f5, #d9d9d9);
    padding: 15px;
    border-radius: 0;
    border: none;
}
.table-panel .table-panel-heading .title {
    color: #555;
    font-size: 22px;
    font-weight: 700;
    text-transform: capitalize;
    line-height: 35px;
    margin: 0;
}

.table-panel .table-body {
    padding: 0;
}
.table-panel .table-body .table {
    background: linear-gradient(
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    border: 1px solid #dedede;
}
.table-panel .table-body .table thead tr th {
    color: #555;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    text-align: center;
    padding: 15px;
    border: none;
    border: 1px solid #dedede;
}
.table-panel .table-body .table tbody tr td {
    color: #777;
    font-size: 15px;
    padding: 15px;
    vertical-align: middle;
    border: 1px solid #dedede;
}
.table-panel .table-body .table tbody .action-list {
    padding: 0;
    margin: 0;
    list-style: none;
}
.table-panel .table-body .table tbody .action-list li {
    margin: 0 5px;
    display: inline-block;
}
.table-panel .table-body .table tbody .action-list li a {
    font-size: 15px;
    line-height: 33px;
    height: 35px;
    width: 35px;
    padding: 0;
    transition: all 0.3s ease 0s;
}

.pagination {
    margin: 0;
}

@media only screen and (max-width: 767px) {
    .table-panel .table-panel-heading .title {
        text-align: center;
        margin: 0 0 10px;
    }
    .table-panel .table-panel-heading .btn-group {
        font-size: 0;
        text-align: center;
        margin: 0 auto;
        display: block;
    }
    .table-panel .table-panel-heading .btn-group .btn {
        float: none;
    }
}
</style> -->
