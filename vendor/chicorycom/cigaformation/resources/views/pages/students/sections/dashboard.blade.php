<template class="task-template">
    <section id="{{ $view }}" class="d-flex justify-content-center align-items-center h-100">
        <div class="welcome ">
            <div class="sh_content row"> </div>
        </div>
    </section>
</template>

<script type="text/javascript">
    (function() {
        const $_content =  document.querySelector('.sh_content');
        window.nav_data.forEach(data => {
            if(data.slug !== 'dashboard'){
                const div = document.createElement('div');
                const img = document.createElement('img');
                const span = document.createElement('span');
                div.className = 'col-md-3 shortcut shadow rounded d-flex flex-column justify-content-center align-items-center';
                img.src = data.icon;
                img.alt = data.name;
                span.className = 'shortcut-label';
                span.appendChild(document.createTextNode(data.name));
                div.appendChild(img)
                div.appendChild(span)
                div.style.background = getRandomColor();
                $_content.appendChild(div)
                div.addEventListener('click', () => {
                    const section = document.querySelector(`a[data-section="${data.slug}"]`);
                    if (section) section.click()
                })
            }

        })
    })();
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }


</script>
