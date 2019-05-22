<template>
    <div class="card">
        <slot name="header"></slot>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "Card"
    }
</script>

<style lang="scss" scoped>

    .card {
        max-width: 500px;
        margin: 8px;
        box-shadow: 3px 5px 17px -11px black;
        padding: 12px;

    }

    /*@import "~bootstrap/scss/buttons";*/
</style>