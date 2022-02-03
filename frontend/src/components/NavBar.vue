<template>
    <div id="app1">
            <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
                <div class="container-fluid">
                    <div class="navbar-brand">Book Store</div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active"><router-link to="/">Home</router-link></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"><router-link to="/userprofile">Profile</router-link></a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
    </div>
</template>

<script>
    export default {
    
    }
</script>

<style>
a{
    text-decoration: wavy;
}
#app1{
    margin-top:10px;
}
</style>