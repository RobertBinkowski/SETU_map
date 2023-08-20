<template>
    <main>
        <h1>Admin Page</h1>
        <NavigationComponent></NavigationComponent>
        <div class="table">
            <!-- <TableComponent :data="searches" :edit="false"></TableComponent> -->
        </div>
    </main>
</template>
  
<script>
import NavigationComponent from "@/components/admin/NavigationComponent.vue";
import TableComponent from "@/components/admin/TableComponent.vue";

export default {
    components: {
        NavigationComponent,
        TableComponent
    },
    setup() {
        let searches = ref([]);


        async function getSearches() {
            const { data } = await axios.get("http://localhost:8000/api/searches");
            searches.value = data;
        }

        getSearches();

        return { searches };
    },
};
</script>
  
<style lang="scss" scoped>
@import "@/assets/variables.scss";
</style>
  