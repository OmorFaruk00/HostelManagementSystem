<template>
    <div>
        <div class="form-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 mx-auto mt-5">
                        <form class="form-horizontal">
                            <h3 class="title">Login Form</h3>
                            <div class="form-group">
                                <label>E-mail Address</label>
                                <input
                                    class="form-control user"
                                    placeholder="Email"
                                />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input
                                    class="form-control password"
                                    placeholder="password"
                                />
                            </div>
                            <div style="text-align: right">
                                <button class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <button class="btn">
                                    <img src="/images/edit.png" />
                                </button>
                                <button class="btn">
                                    <img
                                        height="30px"
                                        src="/images/delete.png"
                                    />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style>
.remove-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}
.form-horizontal {
    position: relative;
    background: linear-gradient(
        50deg,
        rgba(0, 0, 0, 0.05) 49%,
        rgba(0, 0, 0, 0.08) 50%
    );
    font-family: "Quicksand", sans-serif;
    width: 100%;
    padding: 30px 15px 25px;
    border-radius: 30px 0 30px 0;
    padding: 30px;
    box-shadow: 4px 4px 0 #fff, 6px 6px 0 #e7e7e7, -4px -4px 0 #fff,
        -6px -6px 0 #e7e7e7;
}

.form-horizontal .title {
    color: #333;
    font-size: 30px;
    font-weight: 700;
    text-transform: capitalize;
    text-align: center;
    margin: 0 0 30px 0;
}
.form-horizontal .form-group {
    margin: 0 0 15px;
}
.form-horizontal label {
    font-size: 15px;
}
.form-horizontal .form-control {
    color: #0097e6;
    background-color: rgba(255, 255, 255, 0.9);
    font-size: 16px;
    letter-spacing: 1px;
    height: 40px;
    padding: 2px 15px 2px 15px;
    box-shadow: 0 0 5px -3px #333;
    border: none;
    border-radius: 10px;
    transition: all 0.3s;
}
.form-horizontal .form-control:focus {
    box-shadow: 0 0 5px -1px #0097e6;
    border: none;
}
.form-horizontal .form-control::placeholder {
    color: rgba(0, 0, 0, 0.3);
    font-size: 14px;
}

.form-horizontal {
    color: #333;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s;
}

.form-horizontal .btn {
    color: #fff;
    background-color: #0097e6;
    font-size: 20px;
    width: 100px;
    padding: 5px 20px;
    margin: 10px 0 15px 0;
    border-radius: 1px;
    border: none;
    border-radius: 20px;
    display: inline-block;
    transition: all 0.3s;
}
.form-horizontal .btn:hover {
    background-color: #000;
    box-shadow: 2px 2px 5px #333;
}
</style>
