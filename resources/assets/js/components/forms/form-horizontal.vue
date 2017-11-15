<template>
    <form @submit="$emit('submit', $event)" class="col-md-12">
        <slot></slot>
    </form>
</template>

<script>export default {}</script>
