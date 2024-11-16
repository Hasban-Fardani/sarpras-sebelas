import Axios from 'axios'

const axios = Axios.create({
    baseURL: `${process.env.API_URL}/api`,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
    withCredentials: true,
    withXSRFToken: true
})

export default axios
