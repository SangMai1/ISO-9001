<div class="sidebar" data-color="azure" data-background-color="white">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

Tip 2: you can also add an image using data-image tag
-->

    <div class="logo"><span class="simple-text logo-normal">
            ISO-9001
        </span></div>
    <div class="sidebar-wrapper">
        <ul class="list-unstyled nav sidebar-ul">
            <script>
                {
                    let current = document.currentScript
                    let menu = localStorage.getItem('menu')
                    if (menu === null) $.get('/menu/user-menu').then(resp => {
                        const menu = Utils.render.nojs(resp)
                        localStorage.setItem('menu', menu[0].outerHTML) 
                        $(current).replaceWith(menu)
                    })
                    else $(current).replaceWith(Utils.render.nojs(menu))
                }
            </script>
        </ul>
    </div>
</div>
