<?php include_once "layouts/head.layout.php" ?>
    <div class="container">
        <!-- Navbar -->
        <?php include_once "components/navbar.component.php" ?>

        <div class="row">
            <!-- Sidebar -->
            <?php include_once "components/sidebar.component.php" ?>

            <!-- Main Bar -->
            <div class="col-lg-9 col-12 mt-md-0 mt-4 desc-area">
                <!-- Dashboard Greeting -->
                <?php include_once "partials/_salutedb.partial.php" ?>

                <div class="row g-4 mt-3">
                    <!-- Admin Panel Visitors -->
                    <?php include_once "partials/_visitors.partial.php" ?>

                    <!-- Courses Action -->
                    <?php include_once "partials/_course-action.partial.php" ?>
                    
                </div>
                <!-- Course Transaction Table -->
                <?php include_once "components/course-trans.component.php" ?>

            </div>
        </div>
    </div>

    <div style="padding-bottom: 50px;"></div>

<?php include_once "layouts/bottom.layout.php" ?>