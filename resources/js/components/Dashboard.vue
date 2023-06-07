<template>
    <div>
        <table class="table">
            <tr>
                <th v-for="(v, col) in users[0]">
                    {{col}}
                </th>
            </tr>
            <tr v-for="user in users">
                <td v-for="(field, key) in user" :key="key">{{ field || 'null'}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    props: {
        users: {}
    }
}
</script>

<style scoped>

</style>
