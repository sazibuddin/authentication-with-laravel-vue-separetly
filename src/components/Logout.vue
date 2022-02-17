<template>
    <div>

    </div>
</template>

<script>
export default {
    name: "Logout",
    
    created() {
         localStorage.removeItem("token");
         this.$router.push({ name: "Login" });
    }
}
</script>
<style scoped>
</style>