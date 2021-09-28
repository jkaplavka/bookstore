<template>
    <div>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/admin">Bookstore Admin</a>
            <!-- Sidebar Toggle-->
            <button
                class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
                id="sidebarToggle"
                href="#!"
            >
                <i class="fas fa-bars"></i>
            </button>

            <div
                class="
                    d-none d-md-inline-block
                    ms-auto
                    me-0 me-md-3
                    my-2 my-md-0
                "
            >
                <!-- Navbar Search-->
            </div>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        id="navbarDropdown"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdown"
                    >
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li>
                            <a class="dropdown-item" href="#!">Activity Log</a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav
                    class="sb-sidenav accordion sb-sidenav-dark"
                    id="sidenavAccordion"
                >
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Books</div>
                            <a class="nav-link" href="/admin/books/add">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                New book
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <component
                            :is="currentComponent"
                            v-bind="currentComponentProps"
                        />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import page from 'page'
import { defineComponent, markRaw } from 'vue'

interface IRoutes {
    [index: string]: string
}

export default defineComponent({
    name: 'Admin',
    components: {},
    data: () => ({
        currentComponent: null,
        currentComponentProps: {},
        routes: {
            '/admin': '/dashboard/index',
            '/admin/books': '/books/index',
            '/admin/books/add': '/books/index',
            '/admin/books/:id': '/books/index',
        } as IRoutes,
    }),
    async created() {
        for (const [route, component] of Object.entries(this.routes)) {
            page(route, (ctx) => {
                this.currentComponentProps = ctx.params
                this.currentComponent = markRaw(
                    require(`@/components/admin${component}.vue`).default
                )
            })
        }

        page()
    },
    methods: {
        onBookCreated() {},
    },
})
</script>
