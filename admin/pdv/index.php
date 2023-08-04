<style>
    #order-field {
        height: 45em;
        overflow: auto;
    }

    .order-list {
        height: 18em;
        overflow: auto;
        position: relative;
    }

    .order-list-header {
        position: sticky;
        top: 0;
        z-index: 2 !important;
    }

    .order-body {
        position: relative;
        z-index: 1 !important;
    }

    #order-field:empty {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #order-field:empty:after {
        color: #b7b4b4;
        font-size: 1.7em;
        font-style: italic;
    }

    .mt-n4,
    .my-n4 {
        margin-top: -0.9rem !important;
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        padding: .5rem;
        background-color: rgb(213, 218, 222);
    }

    .primary-box {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        margin: 0;
        padding: 11px 10px;
        width: 35%;
        height: 37%;
        background-color: rgb(204, 204, 204);
    }

    .secundary-box {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 2rem;
        display: inline-block;
        width: 35%;
        margin-top: 8px;
        height: 61%;
        background-color: rgb(204, 204, 204);
    }

    .main-box {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 2rem;
        display: inline-flex;
        width: 63.7%;
        margin-top: 8px;
        height: 86.5%;
        background-color: rgb(204, 204, 204);
        position: absolute;
        top: 0;
        right: 17px;
    }

    .screen{
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 2rem;
        display: inline-block;
        width: 97%;
        margin-top: 8px;
        height: 97.5%;
        background-color: rgb(255, 255, 255);
        position: absolute;
        top: 0;
        right: 10px;
    }

    .bottompt1-box {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.9rem;
        display: inline-block;
        width: 25%;
        margin-top: 8px;
        height: 0%;
        background-color: rgb(204, 204, 204);
    }

    .bottompt2-box {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.9rem;
        display: inline-block;
        width: 39%;
        margin-top: 8px;
        height: 0%;
        background-color: rgb(204, 204, 204);
    }

    .produto-search {
        font-size: 1.1rem;
        font-weight: 400;
    }

</style>
<link rel="stylesheet" href="../static/css/services/bootstrap.min.css">
</div>
<div class="justify-content-center">
    <div>
        <div class="card rounded-0">
            <div class="card-body">
                <div id="order-field">
                <div class="primary-box">
                    <h3 class="produto-search">Produto:</h3>
                    <div class="input-group">
                        <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon" style="cursor: pointer;">
                            <i class="fas fa-search"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="main-box">
                    <div class="screen">
                        
                    </div>
                </div>
                <div class="secundary-box">
                </div>
                <div class="bottompt1-box">
                </div>
                <div class="bottompt2-box">
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(function () {
    $('body').addClass('sidebar-collapse');
    var load_data = setInterval(() => {
        get_order();
    }, 500);
});
</script>