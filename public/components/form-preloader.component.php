<style>
    .preloader-div {
        display: none;
    }
    .preloader {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        background-color: #22262a;
        height: 100%;
        z-index: 4;
        overflow: hidden;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
        display: flex;
    }
    .preloader img {
        margin-bottom: 15px;
    }
</style>
<div class="preloader-div">
    <div class="preloader">
        <img src="image/loading.gif" alt="verified">
        <h1>Loading...</h1>
    </div>
</div>