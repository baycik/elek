import {createRouter, createWebHashHistory} from 'vue-router'
const routes=[
    {
        path:'/',
        name:'TextList',
        component:()=>import('@/components/TextList.vue')
    },
    {
        path:'/sentence-list',
        name:'SentenceList',
        component:()=>import('@/components/SentenceList.vue')
    },
    {
        path:'/word-list',
        name:'WordList',
        component:()=>import('@/components/WordList.vue')
    },
]
const router = createRouter({
    history:createWebHashHistory(process.env.BASE_URL),
    routes
})
export default router