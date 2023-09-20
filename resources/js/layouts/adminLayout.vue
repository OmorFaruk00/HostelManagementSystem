<template>
    <div>
        <div class="sticky-top">
    <nav class="navbar navbar-expand-lg topnav d-flex justify-content-between">
     <div class="d-flex">
        <span class="menu" id="menu-toggle"><i class="fa fa-bars"></i>
      </span>      
        <h4 class="cms-title">Hostel Management System</h4>     
     </div>
      <div class="">
        <div class="dropdown">
          <img src="/images/user3.png" alt="user" class="user-icon" @click="userprofile()">
          <div id="user" class="dropdown-content pt-4">
            <div class="user-info d-flex justify-content-center">
              <img src="/images/user1.png" alt="image" class="profile" />
            </div>
            
            <div class="user-text">
                <h4 class="text-center mt-3">{{ user }}</h4>
              <p ></p>               
            </div>
            <hr>           

            <div class="btn-hover">             
              <span class="profile-btn" > <img src="/images/change.png" alt="">Change Password</span>              

            </div>
            <div class="btn-hover">
              <span class="profile-btn"  @click="logout"><img src="/images/logout.png" alt=""  class="">Log out</span>        

            </div>        
           
          </div>
        </div>
      </div>
    </nav>
  </div>


      <div class="d-flex " id="wrapper">
        <div id="sidebar-wrapper" class="">
          <div class="list-group sidebar">
            <router-link class="sidebar-menu" to="/dashboard"><img src="/images/dashboard.png" alt="">
              Dashboard</router-link>
              <!-- <router-link class="sidebar-menu" to="/home"><img src="/images/dash.png" alt="">
              home</router-link>              -->
  
            <div class="sidebar-menu" @click.prevent="account = !account">
              <span><img src="/images/setting.png" alt="" />
               Setting
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" fill="currentColor"
                  class="bi bi-chevron-down float-right mt-2 mr-4 font-weight-bolder" viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
              </span>
            </div>
            <div v-if="account" class="dropdown_item">
              <router-link class="sidebar-item" to="/hostel"><img src="/images/hostel.png" alt="" />Hostel
              </router-link>
             
             
            </div>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
          <div class="container">
            <router-view />
          </div>
        </div>
        <!-- /#page-content-wrapper -->
      </div>
    </div>
    <!-- /#wrapper -->
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  export default {
      data() {
          return {       
              account:false,
              user:localStorage.getItem('user'),
              router:useRouter(),
        
      }
    },
    mounted() {
      $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
     
    });
 
  },
  methods: {

    userprofile() {
      document.getElementById("user").classList.toggle("show");
    },   
    logout() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        this.router.push({name:'Login'});
    }
  }
  
  };
  </script>
  <style scoped>

  .profile {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin: 0px 50px;
  /* padding: 0px 40px; */
}
.profile-btn{
    color: #A82682 !important;
    font-weight: 800;
    text-align: left;
    font-size: 20px;
    line-height: 50px;

}
.btn-hover:hover{background: #f5f5f5;cursor: pointer;}
.profile-btn img{
  height: 18px;

}
@media only screen and (max-width: 767px){
    .btn{ margin-bottom: 30px; }
}
.cms-title {
  padding-left: 50px;
  color:#000;
}
.dropdown {
  float: right;
  position: relative;
  display: inline-block;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 300px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  right: 0;
  z-index: 1111;
  margin-top: 20px;
  margin-right: 15px;
  border-radius: 5px;
  padding-bottom: 30px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {
  background-color: #ddd;
}
.show {
  display: block;
}

.user-icon {
  height: 40px;
  padding-right: 50px;
  cursor: pointer;  
}
.topnav {
  background: #1A86CD;
  position: sticky;
  top: 0px;
}

  .dropdown_item a {
    border: none;
    padding-left: 45px;
    line-height: 40px;
    color: #000;
    display: block;
    font-size: 14px;
    cursor: pointer;
    margin-left: -20px;
  
  }
  
  #wrapper {
    display: flex;
    height: 100%;
  }
  
  .sidebar {
    line-height: 40px;
  }
  .sidebar-menu {
    text-decoration: none; 
    color: #000;
  } 
  .sidebar-menu:hover {
    background: #fff !important;
    cursor: pointer;  
  }  
  .sidebar-menu svg {
    height: 25px;
    padding-bottom: 8px !important; 
    color:#000;
    margin-left: 10px; 
  }
  
  .sidebar-item {
    font-size: 15px;
    color: #000;
    margin: 5px 0px;
    text-decoration: none;
    padding-left: 40px !important;
  }
  
  .sidebar-item:hover {
    background: #fff !important;  
  }
  
  .sidebar-item svg,
  img {
    height: 15px;    
    color: #000;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;   
    margin-left: 20px;
    margin-right: 10px;
  }
  
  .router-link-exact-active {
    background: #fff !important;
  }
  
  .router-link-exact-active svg,
  .router-link-exact-active img {  
    color: #fff;
  }
  
  #sidebar-wrapper {
    min-height: 100vh;
    margin-left: -15rem;
    -webkit-transition: margin 0.25s ease-out;
    -moz-transition: margin 0.25s ease-out;
    -o-transition: margin 0.25s ease-out;
    transition: margin 0.25s ease-out;
    padding-top: 50px;
    background: #1A86CD;  
  
  }
  
  #menu-toggle {
    margin-left: 35px;
    font-size: 25px;
    background: #1A86CD;
  }
  
  #menu-toggle:hover {
    cursor: pointer;
    
  }
  
  #menu-toggle img {
    height: 15px;
  }
  
  #sidebar-wrapper .sidebar-heading {
    padding: 0.875rem 1.25rem;
    font-size: 1.2rem;
  }
  
  #sidebar-wrapper .list-group {
    width: 15rem;
  }
  
  #page-content-wrapper {
    flex: 1; /* Allow the content container to fill the remaining width */
    /* margin-left: 250px; */
    display: block;
    justify-content: center; /* Center the content horizontally */
    align-items: center;
  
  }
  
  #menu-toggle #page-content-wrapper {    
    padding-left: 0px;  
  }
  
  #wrapper.toggled #page-content-wrapper {
    padding-left: 0px;
  }
  
  #wrapper.toggled #sidebar-wrapper {
    margin-left: 0;
    padding-left: 0px;
  }
  
  @media (min-width: 768px) {
    #sidebar-wrapper {
      margin-left: 0;
    }
  
    #page-content-wrapper {
      min-width: 0;
      width: 100%;
    }
  
    #wrapper.toggled #sidebar-wrapper {
      margin-left: -15rem;
    }
  }
  
  @media only screen and (max-width: 780px) {
    #page-content-wrapper {
      padding-left: 0px;
  
    }
  
    #wrapper.toggled #page-content-wrapper {
      padding-left: 250px;
    }
  }
  </style>
  