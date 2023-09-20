import axios from 'axios';

// Set the default base URL for your API
axios.defaults.baseURL = 'http://localhost:8000/api/';

// Set the default headers, including the Authorization header
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

export default axios;