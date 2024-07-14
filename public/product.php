<?php include_once "layouts/head.layout.php" ?>    
    
    <?php include_once "components/navbar.component.php" ?>

    <?php include_once "partials/_jumbotron.partial.php" ?>

<div class="go-up">

    <?php include_once "partials/_learn-section.component.php" ?>

    <?php include_once "components/top-related.component.php" ?>

    <?php include_once "components/footer.component.php" ?>

</div>
    <?php include_once "components/go-upbtn.component.php" ?>

    <script>
        const desc = document.querySelector("#description")
        const goUp = document.querySelector(".go-up")
        const priceCard = document.querySelector(".pricing-card")
        const upBtn = document.querySelector(".up-btn")

        let observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                // entry.target.classList.toggle("fixed", entry.isIntersecting)
                if (entry.isIntersecting) {
                    priceCard.classList.add("fixed")
                } else {
                    priceCard.classList.remove("fixed")
                }
            })
        }, {
            threshold: 0.6
        });
        let upBtnObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                // entry.target.classList.toggle("fixed", entry.isIntersecting)
                if (entry.isIntersecting) {
                    upBtn.classList.add("show")
                } else {
                    upBtn.classList.remove("show")
                }
            })
        }, {
            threshold: 0.3
        })
        observer.observe(desc)
        upBtnObserver.observe(goUp)
    </script>
<?php include_once "layouts/bottom.layout.php" ?>

<?php include_once "partials/_modal.partial.php" ?>