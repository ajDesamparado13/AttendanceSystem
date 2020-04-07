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
                path: "/dashboard/roles",
                component: () => import("../pages/roles/index")
            },
            {
                path: "/dashboard/employees",
                component: () => import("../pages/employees/index")
            }
        ]
    },
    {
        path: "/roles/:id",
        component: () => import("../layouts/Dashboard"),
        meta: { needAuth: true },
        children: [
            {
                path: "/roles/create",
                component: () => import("../pages/roles/create")
            },
            {
                path: "/roles/:id/edit",
                component: () => import("../pages/roles/edit")
            },
            {
                path: "/roles/:id/delete",
                component: () => import("../pages/roles/delete")
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
