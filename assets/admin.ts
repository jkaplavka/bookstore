import { createApp } from 'vue'
import App from '@/pages/admin.vue'
import './styles/sb-admin/styles.scss'

createApp(App).mount('#app')

// SB admin script
window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle')
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault()
            document.body.classList.toggle('sb-sidenav-toggled')
            // localStorage.setItem(
            //     'sb|sidebar-toggle',
            //     document.body.classList.contains('sb-sidenav-toggled')
            // )
        })
    }
})
