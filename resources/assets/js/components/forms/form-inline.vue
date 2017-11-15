<template>
    <form @submit="$emit('submit', $event)" class="form-inline">
        <slot></slot>
    </form>
</template>

<script>export default {}</script>
