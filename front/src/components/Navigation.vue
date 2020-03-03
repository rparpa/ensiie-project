<template>
    <div class="navigationDiv">
        <div><router-link class="b btn btn-warning" to="/Admin">Admin</router-link></div>      
        <div><router-link class="b btn btn-primary" to="/">Map</router-link></div>      
    </div>
</template>


<style>
.navigationDiv{
    background-color: lightgray;
    border: 2px solid darkgray;
    border-radius: 0px 20px 20px 0px;
    padding: 20px;
    text-decoration: none;
}

.navigationDiv .b {
    width: 100%;
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>