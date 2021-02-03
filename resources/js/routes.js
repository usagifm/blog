 import Home from './components/Home';
 import Detail from './components/Detail';
import About from './components/About.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Create from './components/article/create.vue';
import Update from './components/article/update.vue';
import Dashboard from './components/Dashboard.vue';
import Example from './components/ExampleComponent.vue';
import notFound from './components/404.vue';

export default {
    mode: 'history',
    linkActiveClass: 'font-bold',


    routes: [
        {
            path: '*',
            component: notFound
        },
        {
            path: '/',
            component: Home,
            name: 'Home'
        },
        {
            path: '/article/detail/:id',
            component: Detail,
            name: 'Detail'
        },
        {
            path: '/login',
            component: Login,
            name: 'Login',


            beforeEnter: (to, from, next) => {
                axios.get('/api/authenticated').then(()=>{

                    return next({name : 'Dashboard'})
      
                }).catch(()=>{

                    next();

 

                })
            }
        },
        {
            path: '/register',
            component: Register,

            beforeEnter: (to, from, next) => {
                axios.get('/api/authenticated').then(()=>{

                    return next({name : 'Dashboard'})
      
                }).catch(()=>{

                    next();

 

                })
            }

        },
        {   name: "Dashboard",
            path: '/dashboard',
            component: Dashboard,

            beforeEnter: (to, from, next) => {
                axios.get('/api/authenticated').then(()=>{

                    next();
                }).catch(()=>{

                    return next({name : 'Login'})

                })
            }
        },
        {   name: "Create",
        path: '/article/create',
        component: Create,

        beforeEnter: (to, from, next) => {
            axios.get('/api/authenticated').then(()=>{

                next();
            }).catch(()=>{

                return next({name : 'Login'})

            })
        }
    },
    {   name: "Update",
    path: '/article/update/:id',
    component: Update,

    beforeEnter: (to, from, next) => {
        axios.get('/api/authenticated').then(()=>{

            next();
        }).catch(()=>{

            return next({name : 'Login'})

        })
    }
},
        {
            path: '/about',
            component: About 
        } ,
         {
            path: '/example',
            component: Example 
        }



    ]


}