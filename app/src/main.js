import { createApp } from 'vue'
import router from '@/router'
import App from './App.vue'
import FomanticUI from 'vue-fomantic-ui'
import 'fomantic-ui-css/semantic.min.css'



const app=createApp(App)
.use(FomanticUI)
.use(router)

app.config.globalProperties.$conf = {
    hostname:'http://localhost/elek/'
}


app.config.globalProperties.$post = async (uri,request)=>{
    const hostname=app.config.globalProperties.$conf.hostname;
    const url=`${hostname}?page=${uri}`;
    const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        headers: {
            //'Content-Type': 'application/json'
            'Content-Type': 'application/x-www-form-urlencoded',
            'Access-Control-Allow-Origin':'*'
        },
        mode:'cors',
        body: new URLSearchParams(request)
    });
    return response.json();
}
app.mount('#app')