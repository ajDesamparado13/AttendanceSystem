const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("../layouts/Home"),
        children: [
            { path: "/login", component: () => import("../pages/login") },
            { path: "/register", component: () => import("../pages/register") }
        ]
    },
    {
        path: "/user/:id",
        component: () => import("../layouts/Dashboard"),
        meta: { needAuth: true }
    },
    {
        path: "/dashboard/:id",
        component: () => import("../layouts/Dashboard"),
        meta: { needAuth: true },
        children: [
            {
                path: "/dashboard/users",
                component: () => import("../pages/users/index")
            },
            {
                path: "/dashboard/roles",
                component: () => import("../pages/roles/index")
            },
            {
                path: "/dashboard/employees",
                component: () => import("../pages/employees/index")
            },
            {
                path: "/dashboard/timelogs",
                component: () => import("../pages/timelogs/index")
            }
        ]
    },
    {
        path: "/users/:id",
        component: () => import("../layouts/Dashboard"),
        meta: { needAuth: true },
        children: [
            {
                path: "/users/:id/edit",
                component: () => import("../pages/users/edit")
            },
            {
                path: "/users/:id/delete",
                component: () => import("../pages/users/delete")
            }
        ]
    },
    {
        path: "/employees/:id",
        component: () => import("../layouts/Dashboard"),
        meta: { needAuth: true },
        children: [
            {
                path: "/employees/create",
                component: () => import("../pages/employees/create")
            },
            {
                path: "/employees/:id/edit",
                component: () => import("../pages/employees/edit")
            },
            {
                path: "/employees/:id/delete",
                component: () => import("../pages/employees/delete")
            }
        ]
    }
];

export default routes;
