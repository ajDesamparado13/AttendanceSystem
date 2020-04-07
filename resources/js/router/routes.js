import Dashboard from "../layouts/Dashboard";
import Home from "../layouts/Home";
import Login from "../pages/login";
import Register from "../pages/register";

import Roles from "../pages/roles/index";
import RoleCreate from "../pages/roles/create";
import RoleEdit from "../pages/roles/edit";
import RoleDelete from "../pages/roles/delete";

import Employees from "../pages/employees/index";
import EmployeeCreate from "../pages/employees/create";
import EmployeeEdit from "../pages/employees/edit";
import EmployeeDelete from "../pages/employees/delete";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        children: [
            { path: "/login", component: Login },
            { path: "/register", component: Register },
        ],
    },
    {
        path: "/user/:id",
        component: Dashboard,
        meta: { needAuth: true },
    },
    {
        path: "/dashboard/:id",
        component: Dashboard,
        meta: { needAuth: true },
        children: [
            { path: "/dashboard/roles", component: Roles },
            { path: "/dashboard/employees", component: Employees },
        ],
    },
    {
        path: "/roles/:id",
        component: Dashboard,
        meta: { needAuth: true },
        children: [
            { path: "/roles/create", component: RoleCreate },
            { path: "/roles/:id/edit", component: RoleEdit },
            { path: "/roles/:id/delete", component: RoleDelete },
        ],
    },
    {
        path: "/employees/:id",
        component: Dashboard,
        meta: { needAuth: true },
        children: [
            { path: "/employees/create", component: EmployeeCreate },
            { path: "/employees/:id/edit", component: EmployeeEdit },
            { path: "/employees/:id/delete", component: EmployeeDelete },
        ],
    },
];

export default routes;
