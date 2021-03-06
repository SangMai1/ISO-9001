<div class="sidebar" data-color="azure" data-background-color="white">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

Tip 2: you can also add an image using data-image tag
-->

    <div class="logo">
        <div id="close-menu-mobile"><i class="fas fa-times"></i></div>
        <span class="simple-text logo-normal">ISO-9001</span>
    </div>
    <div class="sidebar-wrapper">
        <ul class="list-unstyled nav sidebar-ul">
            <script>
                {
                    let current = document.currentScript
                    let menu = localStorage.getItem('menu')
                    if (menu === null) $.get('/menu/user-menu').then(resp => {
                        const menu = Utils.render.nojs(resp)
                        $(current).replaceWith(menu)
                        localStorage.setItem('menu', menu.parent().html()) 
                    })
                    else $(current).replaceWith(Utils.render.nojs(menu))
                }
            </script>
        </ul>
    </div>
</div>
