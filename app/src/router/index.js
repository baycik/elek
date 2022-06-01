import {createRouter, createWebHashHistory} from 'vue-router'
const routes=[
    {
        path:'/',
        name:'TextList',
        component:()=>import('@/components/TextList.vue')
    }
]
const router = createRouter({
    history:createWebHashHistory(process.env.BASE_URL),
    routes
})
export default router