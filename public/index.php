<?php include_once "layouts/head.layout.php" ?>
    
    <?php include_once "components/navbar.component.php" ?>
    
    <?php include_once "partials/_carousel.partial.php" ?>

    <?php include_once "partials/_navscroller.partial.php" ?>

    <?php include_once "components/top-courses.component.php" ?>
    
<div class="go-up">
    
    <?php include_once "partials/_instructors.partial.php" ?>

    <?php include_once "partials/_testimonial.partial.php" ?>
    
    <?php include_once "components/newsletter.component.php" ?>

    <?php include_once "components/footer.component.php" ?>

</div>
    <?php include_once "components/go-upbtn.component.php" ?>

    <script>
        const goUp = document.querySelector(".go-up")
        const upBtn = document.querySelector(".up-btn")

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
            threshold: 0.2
        })
        upBtnObserver.observe(goUp)
    </script>

<?php include_once "layouts/bottom.layout.php" ?>