<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__descripcion"> Conoce la Conferencia más importante de Latinoamérica</p>

    <div class="devwebcamp__grid">
        <div <?php aos_animation(); ?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" src="build/img/sobre_devwebcamp.jpg" alt="Imagen DevWebCamp" width="200" height="300">
            </picture>
        </div>

        <div class="devwebcamp__contenido">
            <p <?php aos_animation(); ?> class="devwebcamp__texto">consectetur adipisicing elit. Dolores quas qui, tempore nulla labore quisquam nobis dignissimos impedit, consequatur laborum, iste aperiam architecto fugiat dolor veniam illum at voluptatem distinctio?Aperiam assumenda, ex similique optio ullam, eligendi quidem dicta quaerat minima voluptatibus explicabo officiis quisquam voluptates dolorem repellat laudantium ab in animi fugit hic! Ipsa quos recusandae rerum sint quasi.</p>

            <p <?php aos_animation(); ?> class="devwebcamp__texto">consectetur adipisicing elit. Dolores quas qui, tempore nulla labore quisquam nobis dignissimos impedit, consequatur laborum, iste aperiam architecto fugiat dolor veniam illum at voluptatem distinctio?Aperiam assumenda, ex similique optio ullam, eligendi quidem dicta quaerat minima voluptatibus explicabo officiis quisquam voluptates dolorem repellat laudantium ab in animi fugit hic! Ipsa quos recusandae rerum sint quasi.</p>
        </div>
    </div>
</main>
