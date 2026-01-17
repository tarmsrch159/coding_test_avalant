<template>
    <div>
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                <input type="search" class="form-control" v-model="searchName" placeholder="Search Product Name...." />
            </div>

            <div class="col-auto">
                <div class="dropdown">
                    <select name="" id="" v-model="selectedCategory">
                        <option value="all">All</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Accessories">Accessories</option>
                    </select>
                </div>


            </div>
        </div>

        <table class="table-bordered table-striped w-100">
            <thead>
                <tr>
                    <th v-for="columns in column" :key="columns" role="button" @click="sortBy(columns)"
                        class="user-select-none">
                        {{ columns }}
                        <span v-if="sortKey === columns">
                            {{ sortOrder === 'asc' ? '▲' : '▼' }}
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in sortedProducts" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.category }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                </tr>
            </tbody>
        </table>
        <NuxtLink :to="'/'">
            <button class="btn btn-primary mt-3">back to Challenge 1</button>
        </NuxtLink>
    </div>
</template>
<script setup>
import { ref, computed } from 'vue'

const products = ref([
    { id: 1, name: 'Laptop', category: 'Electronics', price: 999, stock: 5 },
    { id: 2, name: 'Mouse', category: 'Accessories', price: 29, stock: 150 },
    { id: 3, name: 'Keyboard', category: 'Accessories', price: 79, stock: 80 },
    { id: 4, name: 'Monitor', category: 'Electronics', price: 299, stock: 12 }
])
const showDropdown = ref(false)


const column = Object.keys(products.value[0])
const selectedCategory = ref('all')

const sortKey = ref(null)
const sortOrder = ref('asc')

const searchName = ref('')
const searchInTable = computed(() => {
    return products.value.filter((productName) => {
        return productName.name.toLowerCase().includes(searchName.value.toLowerCase())
    })
})

const filterCategory = computed(() => {
    return products.value.filter((product) => {
        return product.name.toLowerCase().includes(searchName.value.toLowerCase()) && selectedCategory.value === 'all' || product.category === selectedCategory.value
    })
})

const sortBy = (key) => {
    if (sortKey.value === key) {
        sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc'
    } else {
        sortKey.value = key
        sortOrder.value = 'asc'
    }
}

const sortedProducts = computed(() => {
    if (!sortKey.value) {
        return filterCategory.value
    }

    return [...filterCategory.value].sort((a, b) => {
        const A = a[sortKey.value]
        const B = b[sortKey.value]

        console.log(A, B)
        if (typeof A === 'number') {
            return sortOrder.value === 'asc' ? A - B : B - A
        }

        return sortOrder.value === 'asc'
            ? A.localeCompare(B)
            : B.localeCompare(A)
    })


})


watch(searchName, () => {
    console.log(sortedProducts.value)
})


</script>


<style lang="scss" scoped></style>