import axios from "axios";
// development mode
const baseURL = "http://127.0.0.1:8000";


// auth token
const authToken = localStorage.getItem("token");

export default axios.create({
    baseURL,
    headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${authToken ? authToken : ""}`,
    },
    // You can add your headers here
});